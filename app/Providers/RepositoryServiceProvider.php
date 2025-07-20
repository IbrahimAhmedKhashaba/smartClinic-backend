<?php

namespace App\Providers;

use App\Interfaces\Doctor\Repositories\Disease\DiseaseRepositoryInterface;
use App\Interfaces\Doctor\Repositories\Symptom\SymptomRepositoryInterface;
use App\Interfaces\Doctor\Services\Disease\DiseaseServiceInterface;
use App\Interfaces\Doctor\Services\Symptom\SymptomServiceInterface;
use App\Repositories\Doctor\Disease\DiseaseRepository;
use App\Repositories\Doctor\Symptom\SymptomRepository;
use App\Services\Doctor\Disease\DiseaseService;
use App\Services\Doctor\Symptom\SymptomService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SymptomRepositoryInterface::class, SymptomRepository::class);
        $this->app->bind(SymptomServiceInterface::class, SymptomService::class);
        
        $this->app->bind(DiseaseRepositoryInterface::class, DiseaseRepository::class);
        $this->app->bind(DiseaseServiceInterface::class, DiseaseService::class);
    }
}
