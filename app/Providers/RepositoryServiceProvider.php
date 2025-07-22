<?php

namespace App\Providers;

use App\Interfaces\Doctor\Repositories\Disease\DiseaseRepositoryInterface;
use App\Interfaces\Doctor\Repositories\Symptom\SymptomRepositoryInterface;
use App\Interfaces\Doctor\Services\Disease\DiseaseServiceInterface;
use App\Interfaces\Doctor\Services\Symptom\SymptomServiceInterface;
use App\Interfaces\Patient\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Interfaces\Patient\Services\Appointment\AppointmentServiceInterface;
use App\Repositories\Doctor\Disease\DiseaseRepository;
use App\Repositories\Doctor\Symptom\SymptomRepository;
use App\Repositories\Patient\Appointment\AppointmentRepository;
use App\Services\Doctor\Disease\DiseaseService;
use App\Services\Doctor\Symptom\SymptomService;
use App\Services\patient\Appointment\AppointmentService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\Doctor\Repositories\Appointment\AppointmentRepositoryInterface::class, \App\Repositories\Doctor\Appointment\AppointmentRepository::class);
        $this->app->bind(\App\Interfaces\Doctor\Services\Appointment\AppointmentServiceInterface::class, \App\Services\Doctor\Appointment\AppointmentService::class);

        $this->app->bind(SymptomRepositoryInterface::class, SymptomRepository::class);
        $this->app->bind(SymptomServiceInterface::class, SymptomService::class);
        
        $this->app->bind(DiseaseRepositoryInterface::class, DiseaseRepository::class);
        $this->app->bind(DiseaseServiceInterface::class, DiseaseService::class);
        
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(AppointmentServiceInterface::class, AppointmentService::class);
    }
}
