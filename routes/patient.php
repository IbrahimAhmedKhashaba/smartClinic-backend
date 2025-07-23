<?php

use App\Http\Controllers\Api\Patient\Auth\AuthController;
use App\Http\Controllers\Api\Patient\Appointment\AppointmentController;
use App\Http\Controllers\Api\Patient\Profile\ProfileController;
use App\Http\Controllers\Api\WebSite\Contact\ContactController;
use Illuminate\Support\Facades\Route;

Route::post('contacts' , ContactController::class);

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
        Route::get('profile', [ProfileController::class, 'getProfile']);
        Route::post('profile', [ProfileController::class, 'updateProfile']);
        Route::post('profile/password', [ProfileController::class, 'updatePassword']);
    }
);

