<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\JurnalController;
use App\Http\Controllers\Api\TestController;

// Test route
Route::get('test', [TestController::class, 'test']);

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
Route::middleware(['auth:sanctum'])->group(function () {
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
