<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Simple test route that doesn't require database
Route::get('health', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is healthy!',
        'timestamp' => now()->toISOString(),
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version()
    ]);
});

Route::get('check-extensions', function () {
    $extensions = [
        'pdo' => extension_loaded('pdo'),
        'pdo_mysql' => extension_loaded('pdo_mysql'),
        'pdo_sqlite' => extension_loaded('pdo_sqlite'),
        'mysqli' => extension_loaded('mysqli'),
        'sqlite3' => extension_loaded('sqlite3'),
    ];
    
    return response()->json([
        'success' => true,
        'extensions' => $extensions,
        'all_extensions' => get_loaded_extensions()
    ]);
});

// Test route for API structure
Route::get('test-response', function () {
    return response()->json([
        'success' => true,
        'message' => 'API Response Structure Test',
        'data' => [
            'sample_jurnal' => [
                'id' => 1,
                'judul' => 'Sample Jurnal Title',
                'deskripsi' => 'Sample description',
                'akreditasi' => 'Sinta 1',
                'subject' => 'Teknologi Informasi',
                'penerbit' => 'Sample Publisher',
                'views' => 100
            ]
        ],
        'pagination' => [
            'current_page' => 1,
            'per_page' => 10,
            'total' => 1
        ]
    ]);
});
