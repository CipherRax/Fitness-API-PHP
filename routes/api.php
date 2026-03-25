<?php

// routes/api.php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\Admin\PlanController;
use App\Http\Controllers\Api\Trainer\AttendanceController;

// ---------------------------------------------------------
// PUBLIC ROUTES
// ---------------------------------------------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ---------------------------------------------------------
// PROTECTED ROUTES (Requires Sanctum Token)
// ---------------------------------------------------------
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // === MEMBER ROUTES ===
    // (Assuming default access for authenticated users)
    Route::get('/schedules', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);


    // === TRAINER ROUTES ===
    // Uses the custom CheckRole middleware you created earlier
    Route::middleware(['role:trainer,admin'])->prefix('trainer')->group(function () {
        Route::get('/schedules/{scheduleId}/roster', [AttendanceController::class, 'getRoster']);
        Route::patch('/bookings/{bookingId}/attendance', [AttendanceController::class, 'markAttendance']);
    });


    // === ADMIN ROUTES ===
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        // Automatically maps index, store, update, destroy to the PlanController
        Route::apiResource('plans', PlanController::class)->except(['create', 'edit', 'show']);
    });
});
