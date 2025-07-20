<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\Doctor\Repositories\Symptom\SymptomRepositoryInterface::class, \App\Repositories\Doctor\Symptom\SymptomRepository::class);
        $this->app->bind(\App\Interfaces\Doctor\Services\Symptom\SymptomServiceInterface::class, \App\Services\Doctor\Symptom\SymptomService::class);
        // bindings here
    }
}
