<?php

use App\Http\Controllers\Api\AuthController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Route
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
