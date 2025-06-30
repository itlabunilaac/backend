<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\JurnalController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\SampleController;

// Test routes
Route::get('test', [TestController::class, 'testPublic']);
Route::get('test-token', [TestController::class, 'testToken'])->middleware('admin.auth');

// Sample data routes (for demo purposes)
Route::post('sample/generate', [SampleController::class, 'generateSampleData']);
Route::get('sample/stats', [SampleController::class, 'getStats']);

// API Status and Info
Route::get('status', function () {
    return response()->json([
        'success' => true,
        'message' => 'E-Journal API is running!',
        'version' => '1.0.0',
        'timestamp' => now()->toISOString(),
        'endpoints' => [
            'public' => [
                'GET /api/jurnal - List journals',
                'GET /api/jurnal/{id} - Get journal detail',
                'GET /api/jurnal/subjects - Get subjects',
                'GET /api/jurnal/akreditasi - Get akreditasi',
                'POST /api/admin/login - Admin login',
                'POST /api/admin/register - Admin register'
            ],
            'admin' => [
                'GET /api/admin/profile - Admin profile',
                'POST /api/admin/change-password - Change password',
                'POST /api/admin/logout - Logout',
                'POST /api/admin/jurnal - Create journal',
                'PUT /api/admin/jurnal/{id} - Update journal',
                'DELETE /api/admin/jurnal/{id} - Delete journal'
            ]
        ]
    ]);
});

// Public routes
Route::prefix('admin')->group(function () {
    Route::post('register', [AdminController::class, 'register']);
    Route::post('login', [AdminController::class, 'login']);
});

// Public journal routes (viewing only)
Route::prefix('jurnal')->group(function () {
    Route::get('/', [JurnalController::class, 'index']);
    Route::get('/subjects', [JurnalController::class, 'getSubjects']);
    Route::get('/akreditasi', [JurnalController::class, 'getAkreditasi']);
    Route::get('/{id}', [JurnalController::class, 'show']);
});

// Protected admin routes
Route::middleware(['admin.auth'])->group(function () {
    // Admin profile routes
    Route::prefix('admin')->group(function () {
        Route::get('profile', [AdminController::class, 'profile']);
        Route::post('change-password', [AdminController::class, 'changePassword']);
        Route::post('logout', [AdminController::class, 'logout']);
    });

    // Admin journal management routes
    Route::prefix('admin/jurnal')->group(function () {
        Route::post('/', [JurnalController::class, 'store']);
        Route::put('/{id}', [JurnalController::class, 'update']);
        Route::delete('/{id}', [JurnalController::class, 'destroy']);
    });
});
