<?php

use App\Http\Controllers\Api\Doctor\Appointment\AppointmentController;
use App\Http\Controllers\Api\Doctor\Auth\AuthController;
use App\Http\Controllers\Api\Doctor\Contact\ContactController;
use App\Http\Controllers\Api\Doctor\DaysOff\DaysOffController;
use App\Http\Controllers\Api\Doctor\Disease\DiseaseController;
use App\Http\Controllers\Api\Doctor\Profile\ProfileController;
use App\Http\Controllers\Api\Doctor\Symptom\SymptomController;
use App\Http\Controllers\Api\Doctor\Vacation\VacationController;
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
        Route::apiResource('vacations', VacationController::class)->except(['show']);
        Route::apiResource('days-offs', DaysOffController::class)->except(['show']);
        Route::apiResource('symptoms', SymptomController::class);
        Route::apiResource('diseases', DiseaseController::class);
        Route::apiResource('contacts', ContactController::class)->except(['store', 'update']);
        Route::apiResource('appointments', AppointmentController::class);
        
        Route::controller(AppointmentController::class)->group(function () {
            Route::get('appointments/{id}/patient', 'getAppointmentsByPatientId');
            Route::get('appointments/waiting/status', 'getWaitingAppointments');
            Route::get('appointments/checked/status', 'getCheckedAppointments');
            Route::get('appointments/lated/status', 'getLatedAppointments');
        });

        Route::controller(ProfileController::class)->group(function () {
            Route::get('profile', 'getProfile');
            Route::post('profile', 'updateProfile');
            Route::post('profile/password', 'updatePassword');
        });
    });
});
