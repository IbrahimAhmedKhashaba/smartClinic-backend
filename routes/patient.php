<?php

use App\Http\Controllers\Api\Patient\Auth\AuthController;
use App\Http\Controllers\Api\Doctor\Symptom\SymptomController;
use Illuminate\Http\Request;
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
        'prefix' => 'doctor',
        'middleware' => ['auth:sanctum']
    ],
    function () {
        Route::apiResource('symptoms', SymptomController::class);
    }
);