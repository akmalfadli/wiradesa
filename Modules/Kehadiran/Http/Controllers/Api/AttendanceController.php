<?php

/*
 * @author    Akmal Fadli
 * @copyright Hak Cipta 2025 Akmal Fadli 
 *
 */


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Kehadiran\Models\HariLibur;
use Modules\Kehadiran\Models\JamKerja;
use Modules\Kehadiran\Models\Kehadiran;


defined('BASEPATH') || exit('No direct script access allowed');

class AttendanceController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Set timezone for Indonesia (following OpenSID convention)
        date_default_timezone_set('Asia/Jakarta');
        
        // Set JSON response headers
        header('Content-Type: application/json');
        
        // Check if attendance module is enabled
        if (setting('tampilkan_kehadiran') == '0') {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Attendance module is disabled'
            ], 403);
            return;
        }

        // Rate limiting check
        if (!$this->checkRateLimit()) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Rate limit exceeded. Try again later.'
            ], 429);
            return;
        }

        // Validate content type for POST requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
            if (strpos($contentType, 'application/json') === false) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Content-Type must be application/json'
                ], 400);
                return;
            }
        }

        // Auto check-out users who forgot to check out (following existing cek_kehadiran() function)
        $this->autoCheckOut();
    }

    /**
     * Auto check-out users who forgot to check out after working hours
     */
    private function autoCheckOut()
    {
        try {
            $yesterday = date('Y-m-d', strtotime('-1 day'));
            $current_time = date('H:i');
            
            // Get yesterday's working hours
            $yesterday_day = date('l', strtotime($yesterday));
            $yesterday_day_name = $this->getDayName($yesterday_day);
            
            $jam_kerja = JamKerja::where('nama_hari', $yesterday_day_name)->first();
            
            if ($jam_kerja) {
                // Find users who are still checked in from yesterday
                $forgottenCheckouts = Kehadiran::where('tanggal', $yesterday)
                    ->where('status_kehadiran', 'hadir')
                    ->whereNull('jam_keluar')
                    ->get();

                foreach ($forgottenCheckouts as $attendance) {
                    // Auto check-out with working hours end time
                    $attendance->update([
                        'jam_keluar' => $jam_kerja->jam_keluar,
                        'status_kehadiran' => 'lupa melapor keluar',
                    ]);
                }
            }

            // Also check if current day working hours have passed
            $today = date('Y-m-d');
            $current_day_name = $this->getCurrentDayName();
            $current_jam_kerja = JamKerja::where('nama_hari', $current_day_name)->first();
            
            if ($current_jam_kerja) {
                $rentang_keluar = setting('rentang_waktu_keluar') ?: 10;
                $jam_keluar_akhir = date('H:i', strtotime($current_jam_kerja->jam_keluar . " +{$rentang_keluar} minutes"));
                
                // If current time is past working hours + tolerance
                if ($current_time > $jam_keluar_akhir) {
                    $todayForgottenCheckouts = Kehadiran::where('tanggal', $today)
                        ->where('status_kehadiran', 'hadir')
                        ->whereNull('jam_keluar')
                        ->get();

                    foreach ($todayForgottenCheckouts as $attendance) {
                        // Auto check-out with working hours end time
                        $attendance->update([
                            'jam_keluar' => $current_jam_kerja->jam_keluar,
                            'status_kehadiran' => 'lupa melapor keluar',
                        ]);
                    }
                }
            }

        } catch (Exception $e) {
            // Silent fail - don't break the API if auto checkout fails
            error_log("Auto checkout error: " . $e->getMessage());
        }
    }

    /**
     * Get day name from English day name
     */
    private function getDayName($englishDay)
    {
        // First try to detect what format is used in database
        $sampleRecord = JamKerja::first();
        
        if ($sampleRecord) {
            $namaHari = $sampleRecord->nama_hari;
            
            // Check if it's Indonesian format
            if (in_array($namaHari, ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])) {
                // Indonesian format mapping
                $dayMapping = [
                    'Monday' => 'Senin',
                    'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis',
                    'Friday' => 'Jumat',
                    'Saturday' => 'Sabtu',
                    'Sunday' => 'Minggu'
                ];
                return $dayMapping[$englishDay] ?? $englishDay;
            }
        }
        
        // Return English if database uses English format
        return $englishDay;
    }

    /**
     * Record attendance (check in/out)
     */
    public function record()
    {
        try {
            // Get JSON input
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Invalid JSON input'
                ], 400);
                return;
            }

            // Validate request
            $validation = $this->validateAttendanceRequest($input);
            
            if (!$validation['valid']) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validation['errors']
                ], 400);
                return;
            }

            // Authenticate user
            $user = $this->authenticateUser($input);
            
            if (!$user) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Invalid tag_id_card'
                ], 401);
                return;
            }

            // Check device authorization
            $deviceCheck = $this->validateDevice($input);
            
            if (!$deviceCheck['status']) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => $deviceCheck['message']
                ], 403);
                return;
            }

            // Check working day and hours
            $workingDayCheck = $this->validateWorkingDay();
            
            if (!$workingDayCheck['status']) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => $workingDayCheck['message']
                ], 403);
                return;
            }

            // Process attendance
            $attendanceResult = $this->processAttendance($input, $user);

            $this->jsonResponse($attendanceResult, $attendanceResult['success'] ? 200 : 400);

        } catch (Exception $e) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get attendance history for user
     */
    public function history()
    {
        try {
            // Get JSON input
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Invalid JSON input'
                ], 400);
                return;
            }

            // Authenticate user
            $user = $this->authenticateUser($input);
            
            if (!$user) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Invalid tag_id_card'
                ], 401);
                return;
            }

            $pamong_id = $user->pamong->pamong_id;
            $limit = isset($input['limit']) ? (int)$input['limit'] : 10;
            $page = isset($input['page']) ? (int)$input['page'] : 1;
            $offset = ($page - 1) * $limit;

            // Get attendance records (following existing patterns)
            $attendances = Kehadiran::where('pamong_id', $pamong_id)
                ->orderBy('tanggal', 'desc')
                ->orderBy('jam_masuk', 'desc')
                ->limit($limit)
                ->offset($offset)
                ->get();

            $total = Kehadiran::where('pamong_id', $pamong_id)->count();
            $lastPage = ceil($total / $limit);

            $this->jsonResponse([
                'success' => true,
                'data' => [
                    'user' => [
                        'name' => $user->pamong->pamong_nama ?: ($user->pamong->penduduk->nama ?? ''),
                        'position' => isset($user->pamong->jabatan->nama) ? $user->pamong->jabatan->nama : ''
                    ],
                    'attendances' => $attendances->toArray(),
                    'pagination' => [
                        'current_page' => $page,
                        'last_page' => $lastPage,
                        'per_page' => $limit,
                        'total' => $total
                    ]
                ]
            ]);

        } catch (Exception $e) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get current attendance status
     */
    public function status()
    {
        try {
            // Get JSON input
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Invalid JSON input'
                ], 400);
                return;
            }

            // Authenticate user
            $user = $this->authenticateUser($input);
            
            if (!$user) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Invalid tag_id_card'
                ], 401);
                return;
            }

            $pamong_id = $user->pamong->pamong_id;
            $today = date('Y-m-d');

            // Get current attendance (following existing logic)
            $currentAttendance = Kehadiran::where('pamong_id', $pamong_id)
                ->where('tanggal', $today)
                ->where('status_kehadiran', 'hadir')
                ->first();

            $isCheckedIn = $currentAttendance && is_null($currentAttendance->jam_keluar);
            
            $this->jsonResponse([
                'success' => true,
                'data' => [
                    'user' => [
                        'name' => $user->pamong->pamong_nama ?: ($user->pamong->penduduk->nama ?? ''),
                        'position' => isset($user->pamong->jabatan->nama) ? $user->pamong->jabatan->nama : ''
                    ],
                    'is_checked_in' => $isCheckedIn,
                    'current_attendance' => $currentAttendance ? $currentAttendance->toArray() : null,
                    'date' => $today,
                    'time' => date('H:i:s'),
                    'device_info' => [
                        'ip_address' => $input['ip_address'],
                        'mac_address' => $input['mac_address']
                    ]
                ]
            ]);

        } catch (Exception $e) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send JSON response and exit
     */
    private function jsonResponse($data, $httpCode = 200)
    {
        http_response_code($httpCode);
        echo json_encode($data);
        exit;
    }

    /**
     * Check rate limiting
     */
    private function checkRateLimit()
    {
        $ip = $this->input->ip_address();
        $key = 'attendance_api_' . $ip;
        
        // Simple file-based rate limiting
        $rateLimitFile = APPPATH . 'cache/rate_limit_' . md5($key) . '.json';
        $maxAttempts = 60; // requests per hour
        $decayMinutes = 60; // 1 hour
        
        $now = time();
        $data = [];
        
        if (file_exists($rateLimitFile)) {
            $content = file_get_contents($rateLimitFile);
            $data = $content ? json_decode($content, true) : [];
            if (!$data) $data = [];
        }
        
        // Clean old entries
        $data = array_filter($data, function($timestamp) use ($now, $decayMinutes) {
            return ($now - $timestamp) < ($decayMinutes * 60);
        });
        
        if (count($data) >= $maxAttempts) {
            return false;
        }
        
        // Add current request
        $data[] = $now;
        
        // Save to file
        if (!is_dir(APPPATH . 'cache')) {
            mkdir(APPPATH . 'cache', 0755, true);
        }
        file_put_contents($rateLimitFile, json_encode($data));
        
        return true;
    }

    /**
     * Validate attendance request
     */
    private function validateAttendanceRequest($input)
    {
        $errors = [];

        if (empty($input['ip_address'])) {
            $errors['ip_address'] = ['IP address is required'];
        } elseif (!filter_var($input['ip_address'], FILTER_VALIDATE_IP)) {
            $errors['ip_address'] = ['Invalid IP address format'];
        }

        if (empty($input['mac_address'])) {
            $errors['mac_address'] = ['MAC address is required'];
        }

        if (empty($input['tag_id_card'])) {
            $errors['tag_id_card'] = ['Tag aid card is required'];
        }

        if (empty($input['action'])) {
            $errors['action'] = ['Action is required'];
        } elseif (!in_array($input['action'], ['check_in', 'check_out'])) {
            $errors['action'] = ['Action must be check_in or check_out'];
        }

        // Optional fields validation
        if (isset($input['latitude'])) {
            if (!is_numeric($input['latitude']) || $input['latitude'] < -90 || $input['latitude'] > 90) {
                $errors['latitude'] = ['Latitude must be between -90 and 90'];
            }
        }

        if (isset($input['longitude'])) {
            if (!is_numeric($input['longitude']) || $input['longitude'] < -180 || $input['longitude'] > 180) {
                $errors['longitude'] = ['Longitude must be between -180 and 180'];
            }
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    /**
     * Authenticate user by device parameters (following existing PerangkatController logic)
     */
    private function authenticateUser($input)
    {
        $tag_id_card = $input['tag_id_card'];

        $user = User::with(['pamong'])
            ->whereHas('pamong', function ($query) use ($tag_id_card) {
                $query->where('pamong_status', 1) // pamong aktif (following existing logic)
                    ->where(function ($query) use ($tag_id_card) {
                        $query->where('pamong_tag_id_card', $tag_id_card)
                            ->orWhereHas('penduduk', function ($query) use ($tag_id_card) {
                                $query->where('tag_id_card', $tag_id_card);
                            });
                    });
            })
            ->first();

        return $user;
    }

    /**
     * Validate device authorization (enhanced from existing deteksi() method)
     */
    private function validateDevice($input)
    {
        $ip_address = $input['ip_address'];
        $mac_address = $input['mac_address'];

        // Following existing PerangkatController logic
        $ip_valid = (setting('ip_adress_kehadiran') === $ip_address && setting('ip_adress_kehadiran') !== null);
        $mac_valid = (setting('mac_adress_kehadiran') === $mac_address && setting('mac_adress_kehadiran') !== null);
        
        // Allow if no settings are configured OR if device matches configured settings
        $cek_gawai = $ip_valid || $mac_valid || 
                    (setting('ip_adress_kehadiran') === null && setting('mac_adress_kehadiran') === null);

        if (!$cek_gawai) {
            $message = 'Gawai ini belum terdaftar.';
            if (setting('ip_adress_kehadiran') !== null && !$ip_valid) {
                $message .= " IP address tidak sesuai.";
            }
            if (setting('mac_adress_kehadiran') !== null && !$mac_valid) {
                $message .= " MAC address tidak sesuai.";
            }
        }

        return [
            'status' => $cek_gawai,
            'message' => $cek_gawai ? 'Device authorized' : $message
        ];
    }

    /**
     * Get current day name in the format stored in database
     */
    private function getCurrentDayName()
    {
        $dayOfWeek = date('N'); // 1=Monday, 7=Sunday
        
        // Try to find which format is used in the database by checking existing records
        $sampleRecord = JamKerja::first();
        
        if ($sampleRecord) {
            $namaHari = $sampleRecord->nama_hari;
            
            // Check if it's Indonesian format
            if (in_array($namaHari, ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])) {
                // Indonesian format
                $indonesianDays = [
                    1 => 'Senin',
                    2 => 'Selasa',
                    3 => 'Rabu', 
                    4 => 'Kamis',
                    5 => 'Jumat',
                    6 => 'Sabtu',
                    7 => 'Minggu'
                ];
                return $indonesianDays[$dayOfWeek];
            }
        }
        
        // Default to English format (as in original code)
        $englishDays = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday', 
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday'
        ];
        
        return $englishDays[$dayOfWeek];
    }

    /**
     * Manual trigger for auto check-out (for admin use)
     * POST /api/kehadiran/auto-checkout
     */
    public function auto_checkout()
    {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            // Optional: Add admin authentication here
            // For now, we'll allow it but you can add admin verification
            
            $processedCount = 0;
            $results = [];
            
            // Process yesterday's forgotten checkouts
            $yesterday = date('Y-m-d', strtotime('-1 day'));
            $yesterday_day = date('l', strtotime($yesterday));
            $yesterday_day_name = $this->getDayName($yesterday_day);
            
            $jam_kerja_yesterday = JamKerja::where('nama_hari', $yesterday_day_name)->first();
            
            if ($jam_kerja_yesterday) {
                $forgottenYesterday = Kehadiran::with(['pamong'])
                    ->where('tanggal', $yesterday)
                    ->where('status_kehadiran', 'hadir')
                    ->whereNull('jam_keluar')
                    ->get();

                foreach ($forgottenYesterday as $attendance) {
                    $attendance->update([
                        'jam_keluar' => $jam_kerja_yesterday->jam_keluar,
                        'status_kehadiran' => 'lupa melapor keluar',
                    ]);
                    
                    $processedCount++;
                    $results[] = [
                        'date' => $yesterday,
                        'employee' => $attendance->pamong->pamong_nama ?: ($attendance->pamong->penduduk->nama ?? ''),
                        'auto_checkout_time' => $jam_kerja_yesterday->jam_keluar,
                        'status' => 'lupa melapor keluar'
                    ];
                }
            }

            // Process today's forgotten checkouts (if past working hours)
            $today = date('Y-m-d');
            $current_time = date('H:i');
            $current_day_name = $this->getCurrentDayName();
            $current_jam_kerja = JamKerja::where('nama_hari', $current_day_name)->first();
            
            if ($current_jam_kerja) {
                $rentang_keluar = setting('rentang_waktu_keluar') ?: 10;
                $jam_keluar_akhir = date('H:i', strtotime($current_jam_kerja->jam_keluar . " +{$rentang_keluar} minutes"));
                
                if ($current_time > $jam_keluar_akhir) {
                    $forgottenToday = Kehadiran::with(['pamong'])
                        ->where('tanggal', $today)
                        ->where('status_kehadiran', 'hadir')
                        ->whereNull('jam_keluar')
                        ->get();

                    foreach ($forgottenToday as $attendance) {
                        $attendance->update([
                            'jam_keluar' => $current_jam_kerja->jam_keluar,
                            'status_kehadiran' => 'lupa melapor keluar',
                        ]);
                        
                        $processedCount++;
                        $results[] = [
                            'date' => $today,
                            'employee' => $attendance->pamong->pamong_nama ?: ($attendance->pamong->penduduk->nama ?? ''),
                            'auto_checkout_time' => $current_jam_kerja->jam_keluar,
                            'status' => 'lupa melapor keluar'
                        ];
                    }
                }
            }

            $this->jsonResponse([
                'success' => true,
                'message' => "Auto check-out completed. {$processedCount} employees processed.",
                'data' => [
                    'processed_count' => $processedCount,
                    'processed_employees' => $results,
                    'current_time' => date('Y-m-d H:i:s')
                ]
            ]);

        } catch (Exception $e) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Auto check-out failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Debug timezone - call this endpoint to check server time
     * GET /api/kehadiran/debug-time
     */
    public function debug_time()
    {
        $this->jsonResponse([
            'server_timezone' => date_default_timezone_get(),
            'server_time' => date('Y-m-d H:i:s'),
            'server_date' => date('Y-m-d'),
            'server_time_only' => date('H:i'),
            'server_day' => date('l'),
            'indonesia_time' => date('Y-m-d H:i:s', time()),
            'timestamp' => time(),
            'day_name_used' => $this->getCurrentDayName()
        ]);
    }


    /**
     * Get list of users who need auto check-out
     * GET /api/kehadiran/pending-checkout
     */
    public function pending_checkout()
    {
        try {
            $pendingCheckouts = [];
            $current_time = date('H:i');
            $today = date('Y-m-d');
            $yesterday = date('Y-m-d', strtotime('-1 day'));

            // Yesterday's forgotten checkouts
            $yesterdayPending = Kehadiran::with(['pamong'])
                ->where('tanggal', $yesterday)
                ->where('status_kehadiran', 'hadir')
                ->whereNull('jam_keluar')
                ->get();

            foreach ($yesterdayPending as $attendance) {
                $pendingCheckouts[] = [
                    'date' => $yesterday,
                    'employee_name' => $attendance->pamong->pamong_nama ?: ($attendance->pamong->penduduk->nama ?? ''),
                    'pamong_id' => $attendance->pamong_id,
                    'check_in_time' => $attendance->jam_masuk,
                    'reason' => 'Yesterday - forgot to check out',
                    'priority' => 'high'
                ];
            }

            // Today's potential forgotten checkouts (if past working hours)
            $current_day_name = $this->getCurrentDayName();
            $current_jam_kerja = JamKerja::where('nama_hari', $current_day_name)->first();
            
            if ($current_jam_kerja) {
                $rentang_keluar = setting('rentang_waktu_keluar') ?: 10;
                $jam_keluar_akhir = date('H:i', strtotime($current_jam_kerja->jam_keluar . " +{$rentang_keluar} minutes"));
                
                if ($current_time > $jam_keluar_akhir) {
                    $todayPending = Kehadiran::with(['pamong'])
                        ->where('tanggal', $today)
                        ->where('status_kehadiran', 'hadir')
                        ->whereNull('jam_keluar')
                        ->get();

                    foreach ($todayPending as $attendance) {
                        $pendingCheckouts[] = [
                            'date' => $today,
                            'employee_name' => $attendance->pamong->pamong_nama ?: ($attendance->pamong->penduduk->nama ?? ''),
                            'pamong_id' => $attendance->pamong_id,
                            'check_in_time' => $attendance->jam_masuk,
                            'reason' => 'Today - past working hours, not checked out',
                            'priority' => 'medium'
                        ];
                    }
                }
            }

            $this->jsonResponse([
                'success' => true,
                'data' => [
                    'pending_count' => count($pendingCheckouts),
                    'pending_checkouts' => $pendingCheckouts,
                    'current_time' => date('Y-m-d H:i:s'),
                    'working_hours_today' => $current_jam_kerja ? [
                        'start' => $current_jam_kerja->jam_masuk,
                        'end' => $current_jam_kerja->jam_keluar,
                        'tolerance_end' => isset($jam_keluar_akhir) ? $jam_keluar_akhir : null
                    ] : null
                ]
            ]);

        } catch (Exception $e) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Failed to get pending checkouts: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validate working day and hours (with timezone fix)
     */
    private function validateWorkingDay()
    {
        // Ensure we're using the correct timezone
        date_default_timezone_set('Asia/Jakarta');
        
        $today = date('Y-m-d');
        $current_day = $this->getCurrentDayName();
        $current_time = date('H:i');

        // Check holiday - following existing logic
        $cek_hari = HariLibur::where('tanggal', '=', $today)->first();
        
        if ($cek_hari) {
            return [
                'status' => false,
                'message' => $cek_hari->keterangan
            ];
        }

        // Get working hours for current day
        $jam_kerja = JamKerja::where('nama_hari', $current_day)->first();
        
        if (!$jam_kerja) {
            // Debug: Let's see what days are available in the database
            $availableDays = JamKerja::pluck('nama_hari')->toArray();
            return [
                'status' => false,
                'message' => "Jam kerja tidak ditemukan untuk hari {$current_day}. Hari tersedia: " . implode(', ', $availableDays)
            ];
        }

        // Check if today is set as holiday
        if ($jam_kerja->status == 0) {
            return [
                'status' => false,
                'message' => "Hari {$current_day} adalah hari libur"
            ];
        }

        // Check if current time is within working hours (with tolerance)
        $rentang_masuk = setting('rentang_waktu_masuk') ?: 10;
        $rentang_keluar = setting('rentang_waktu_keluar') ?: 10;

        $jam_masuk_awal = date('H:i', strtotime($jam_kerja->jam_masuk . " -{$rentang_masuk} minutes"));
        $jam_keluar_akhir = date('H:i', strtotime($jam_kerja->jam_keluar . " +{$rentang_keluar} minutes"));

        // Check if current time is within allowed range
        if ($current_time < $jam_masuk_awal || $current_time > $jam_keluar_akhir) {
            return [
                'status' => false,
                'message' => "Jam kerja hari ini di mulai dari {$jam_kerja->jam_masuk} hingga {$jam_kerja->jam_keluar} (toleransi: -{$rentang_masuk}mnt/+{$rentang_keluar}mnt). Waktu sekarang: {$current_time}. Timezone: " . date_default_timezone_get()
            ];
        }

        return [
            'status' => true,
            'message' => 'Working hours valid'
        ];
    }

    /**
     * Process attendance (following existing checkInOut() method logic)
     */
    private function processAttendance($input, $user)
    {
        $pamong_id = $user->pamong->pamong_id;
        $today = date('Y-m-d');
        $current_time = date('H:i');  // Using H:i format like existing controller
        $action = $input['action'];

        try {
            DB::beginTransaction();

            if ($action === 'check_in') {
                // Check if already checked in today (following existing logic)
                $existingAttendance = Kehadiran::where('tanggal', $today)
                    ->where('pamong_id', $pamong_id)
                    ->where('status_kehadiran', 'hadir')
                    ->first();

                if ($existingAttendance && is_null($existingAttendance->jam_keluar)) {
                    DB::rollBack();
                    return [
                        'success' => false,
                        'message' => 'Sudah melakukan check in hari ini'
                    ];
                }

                // Create attendance record (following existing checkInOut logic)
                $attendance = Kehadiran::create([
                    'tanggal' => $today,
                    'pamong_id' => $pamong_id,
                    'jam_masuk' => $current_time,
                    'status_kehadiran' => 'hadir',
                ]);

                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Check in berhasil',
                    'data' => [
                        'attendance_id' => $attendance->id,
                        'check_in_time' => $current_time,
                        'date' => $today,
                        'user' => [
                            'name' => $user->pamong->pamong_nama ?: ($user->pamong->penduduk->nama ?? ''),
                            'position' => isset($user->pamong->jabatan->nama) ? $user->pamong->jabatan->nama : ''
                        ]
                    ]
                ];

            } else { // check_out - following existing checkInOut logic
                // Find today's attendance (following existing logic)
                $attendance = Kehadiran::where('tanggal', $today)
                    ->where('pamong_id', $pamong_id)
                    ->latest('jam_masuk')
                    ->first();

                if (!$attendance || $attendance->jam_keluar !== null) {
                    DB::rollBack();
                    return [
                        'success' => false,
                        'message' => 'Belum melakukan check in hari ini atau sudah check out'
                    ];
                }

                $status_kehadiran = isset($input['status_kehadiran']) ? $input['status_kehadiran'] : 'tidak berada di kantor';

                // Update attendance record (following existing logic)
                $attendance->update([
                    'jam_keluar' => $current_time,
                    'status_kehadiran' => $status_kehadiran,
                ]);

                DB::commit();

                // Calculate working duration
                $duration = $this->calculateDuration($attendance->jam_masuk, $current_time);

                return [
                    'success' => true,
                    'message' => 'Check out berhasil',
                    'data' => [
                        'attendance_id' => $attendance->id,
                        'check_out_time' => $current_time,
                        'duration' => $duration,
                        'status' => $status_kehadiran,
                        'date' => $today
                    ]
                ];
            }

        } catch (Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Gagal memproses kehadiran: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Calculate working duration
     */
    private function calculateDuration($start_time, $end_time)
    {
        $start = strtotime($start_time);
        $end = strtotime($end_time);
        $duration = $end - $start;

        $hours = floor($duration / 3600);
        $minutes = floor(($duration % 3600) / 60);

        return sprintf('%02d:%02d', $hours, $minutes);
    }
}