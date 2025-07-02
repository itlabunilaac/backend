<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Redirect ke demo interaktif
    return redirect('/demo');
});

Route::get('/demo', function () {
    // Langsung return demo.html yang sudah ada
    return response()->file(public_path('demo.html'));
});

Route::get('/api-demo', function () {
    return response()->json([
        'message' => 'E-Journal API Demo',
        'endpoints' => [
            'GET /' => 'API Information',
            'GET /test' => 'Test endpoint',
            'GET /api/admins' => 'List admins',
            'GET /api/jurnals' => 'List journals',
            'POST /api/auth/login' => 'Admin login'
        ],
        'timestamp' => now()->toISOString()
    ]);
});

Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Laravel 10 API Test - E-Journal',
        'data' => [
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
            'environment' => app()->environment(),
            'database_connection' => config('database.default'),
            'app_key_set' => !empty(config('app.key')),
            'timestamp' => now()->toISOString()
        ]
    ]);
});