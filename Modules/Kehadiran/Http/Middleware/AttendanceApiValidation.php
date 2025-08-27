<?php

/*
 * @author    Akmal Fadli
 * @copyright Hak Cipta 2025 Akmal Fadli 
 *
 */


namespace Modules\Kehadiran\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AttendanceApiValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check for required fields based on endpoint
        $endpoint = $request->route()->getName();
        
        if (!$this->validateRequiredFields($request, $endpoint)) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields'
            ], 400);
        }

        // Sanitize input data
        $this->sanitizeInput($request);

        return $next($request);
    }

    /**
     * Validate required fields based on endpoint
     *
     * @param Request $request
     * @param string $endpoint
     * @return bool
     */
    private function validateRequiredFields(Request $request, ?string $endpoint): bool
    {
        // Basic required fields for all endpoints
        $requiredFields = ['ip_address', 'mac_address', 'tag_id_card'];

        // Additional fields for record endpoint
        if ($endpoint === 'api.kehadiran.record') {
            $requiredFields[] = 'action';
        }

        foreach ($requiredFields as $field) {
            if (!$request->has($field) || empty($request->input($field))) {
                return false;
            }
        }

        return true;
    }

    /**
     * Sanitize input data
     *
     * @param Request $request
     */
    private function sanitizeInput(Request $request): void
    {
        $input = $request->all();

        // Sanitize string inputs
        $stringFields = ['ip_address', 'mac_address', 'tag_id_card', 'action', 'notes', 'status_kehadiran'];
        
        foreach ($stringFields as $field) {
            if (isset($input[$field])) {
                $input[$field] = trim(strip_tags($input[$field]));
            }
        }

        // Validate IP address format
        if (isset($input['ip_address'])) {
            $input['ip_address'] = filter_var($input['ip_address'], FILTER_VALIDATE_IP);
            if ($input['ip_address'] === false) {
                $input['ip_address'] = null;
            }
        }

        // Validate numeric inputs
        $numericFields = ['latitude', 'longitude', 'limit', 'page'];
        
        foreach ($numericFields as $field) {
            if (isset($input[$field])) {
                $input[$field] = filter_var($input[$field], FILTER_VALIDATE_FLOAT);
            }
        }

        $request->replace($input);
    }
}