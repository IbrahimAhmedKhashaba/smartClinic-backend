<?php

use App\Http\Controllers\Api\Doctor\Appointment\AppointmentController;
use App\Http\Controllers\Api\Doctor\Auth\AuthController;
use App\Http\Controllers\Api\Doctor\Disease\DiseaseController;
use App\Http\Controllers\Api\Doctor\Symptom\SymptomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/doctor')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('profile', [AuthController::class, 'profile']);
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('symptoms', SymptomController::class);
        Route::apiResource('appointments', AppointmentController::class);
        Route::apiResource('diseases', DiseaseController::class);
        Route::get('appointments/{id}/patient', [AppointmentController::class, 'getAppointmentsByPatientId']);
        Route::get('appointments/waiting/status', [AppointmentController::class, 'getWaitingAppointments']);
        Route::get('appointments/checked/status', [AppointmentController::class, 'getCheckedAppointments']);
        Route::get('appointments/lated/status', [AppointmentController::class, 'getLatedAppointments']);
    });
});
