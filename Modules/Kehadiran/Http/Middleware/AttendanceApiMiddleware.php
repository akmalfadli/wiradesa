<?php

/*
 * @author    Akmal Fadli
 * @copyright Hak Cipta 2025 Akmal Fadli 
 *
 */


namespace Modules\Kehadiran\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

defined('BASEPATH') || exit('No direct script access allowed');

class AttendanceApiMiddleware
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
        // Check if attendance module is enabled
        if (setting('tampilkan_kehadiran') == '0') {
            return response()->json([
                'success' => false,
                'message' => 'Attendance module is disabled'
            ], 403);
        }

        // Rate limiting
        $rateLimitResult = $this->checkRateLimit($request);
        if (!$rateLimitResult['allowed']) {
            return response()->json([
                'success' => false,
                'message' => 'Rate limit exceeded. Try again later.',
                'retry_after' => $rateLimitResult['retry_after']
            ], 429);
        }

        // Log API access
        $this->logApiAccess($request);

        // Validate content type for POST requests
        if ($request->isMethod('post') && !$request->isJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Content-Type must be application/json'
            ], 400);
        }

        // Add security headers to response
        $response = $next($request);
        
        return $this->addSecurityHeaders($response);
    }

    /**
     * Check rate limiting
     *
     * @param Request $request
     * @return array
     */
    private function checkRateLimit(Request $request): array
    {
        $key = 'attendance_api_' . $request->ip();
        $maxAttempts = 60; // requests per hour
        $decayMinutes = 60; // 1 hour

        $attempts = Cache::get($key, 0);
        
        if ($attempts >= $maxAttempts) {
            $ttl = Cache::get($key . '_ttl', 0);
            return [
                'allowed' => false,
                'retry_after' => max(0, $ttl - time())
            ];
        }

        // Increment attempts
        Cache::put($key, $attempts + 1, $decayMinutes * 60);
        Cache::put($key . '_ttl', time() + ($decayMinutes * 60), $decayMinutes * 60);

        return [
            'allowed' => true,
            'retry_after' => 0
        ];
    }

    /**
     * Log API access
     *
     * @param Request $request
     */
    private function logApiAccess(Request $request): void
    {
        $logData = [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'endpoint' => $request->path(),
            'method' => $request->method(),
            'device_ip' => $request->input('ip_address', 'unknown'),
            'mac_address' => $request->input('mac_address', 'unknown'),
            'tag_id_card' => $request->input('tag_id_card', 'unknown'),
            'timestamp' => now()->toDateTimeString()
        ];

        Log::channel('daily')->info('Attendance API Access', $logData);
    }

    /**
     * Add security headers to response
     *
     * @param Response $response
     * @return Response
     */
    private function addSecurityHeaders($response)
    {
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Remove server information
        $response->headers->remove('Server');
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
