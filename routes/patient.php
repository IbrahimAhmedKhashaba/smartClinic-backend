<?php

use App\Http\Controllers\Api\Patient\Auth\AuthController;
use App\Http\Controllers\Api\Patient\Appointment\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/patient/auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:patient')->group(function () {
        Route::get('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::group(
    [
        'prefix' => 'patient',
        'middleware' => ['auth:patient']
    ],
    function () {
        Route::apiResource('appointments', AppointmentController::class);
    }
);