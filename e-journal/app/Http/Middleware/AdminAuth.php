<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request - Simplified version using localStorage token
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Token required.'
            ], 401);
        }

        // Simple validation - just check if token exists and looks valid
        if (strlen($token) < 40) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid token format.'
            ], 401);
        }

        // For demo purposes, we'll trust any valid-looking token
        // and use a default admin user
        $admin = Admin::first(); // Get first admin from database
        
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. No admin found.'
            ], 401);
        }

        // Set the authenticated user for this request
        $request->setUserResolver(function () use ($admin) {
            return $admin;
        });

        return $next($request);
    }
}
