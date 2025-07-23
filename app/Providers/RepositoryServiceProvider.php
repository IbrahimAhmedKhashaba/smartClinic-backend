<?php

namespace App\Providers;

use App\Interfaces\Doctor\Repositories\Contact\ContactRepositoryInterface as ContactContactRepositoryInterface;
use App\Interfaces\Doctor\Repositories\DaysOff\DaysOffRepositoryInterface;
use App\Interfaces\Doctor\Repositories\Disease\DiseaseRepositoryInterface;
use App\Interfaces\Doctor\Repositories\Profile\ProfileRepositoryInterface;
use App\Interfaces\Doctor\Repositories\Symptom\SymptomRepositoryInterface;
use App\Interfaces\Doctor\Repositories\Vacation\VacationRepositoryInterface;
use App\Interfaces\Doctor\Services\Contact\ContactServiceInterface as ContactContactServiceInterface;
use App\Interfaces\Doctor\Services\DaysOff\DaysOffServiceInterface;
use App\Interfaces\Doctor\Services\Disease\DiseaseServiceInterface;
use App\Interfaces\Doctor\Services\Profile\ProfileServiceInterface;
use App\Interfaces\Doctor\Services\Symptom\SymptomServiceInterface;
use App\Interfaces\Doctor\Services\Vacation\VacationServiceInterface;
use App\Interfaces\Patient\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Interfaces\Patient\Repositories\Profile\ProfileRepositoryInterface as ProfileProfileRepositoryInterface;
use App\Interfaces\Patient\Services\Appointment\AppointmentServiceInterface;
use App\Interfaces\Patient\Services\Profile\ProfileServiceInterface as ProfileProfileServiceInterface;
use App\Interfaces\WebSite\Repositories\Contact\ContactRepositoryInterface;
use App\Interfaces\WebSite\Repositories\Home\HomeRepositoryInterface;
use App\Interfaces\WebSite\Services\Contact\ContactServiceInterface;
use App\Interfaces\WebSite\Services\Home\HomeServiceInterface;
use App\Repositories\Doctor\Contact\ContactRepository as ContactContactRepository;
use App\Repositories\Doctor\DaysOff\DaysOffRepository;
use App\Repositories\Doctor\Disease\DiseaseRepository;
use App\Repositories\Doctor\Profile\ProfileRepository;
use App\Repositories\Doctor\Symptom\SymptomRepository;
use App\Repositories\Doctor\Vacation\VacationRepository;
use App\Repositories\Patient\Appointment\AppointmentRepository;
use App\Repositories\Patient\Profile\ProfileRepository as ProfileProfileRepository;
use App\Repositories\WebSite\Contact\ContactRepository;
use App\Repositories\WebSite\Home\HomeRepository;
use App\Services\Doctor\Contact\ContactService as ContactContactService;
use App\Services\Doctor\DaysOff\DaysOffService;
use App\Services\Doctor\Disease\DiseaseService;
use App\Services\Doctor\Profile\ProfileService;
use App\Services\Doctor\Symptom\SymptomService;
use App\Services\Doctor\Vacation\VacationService;
use App\Services\patient\Appointment\AppointmentService;
use App\Services\Patient\Profile\ProfileService as ProfileProfileService;
use App\Services\WebSite\Contact\ContactService;
use App\Services\WebSite\Home\HomeService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\Doctor\Repositories\Setting\SettingRepositoryInterface::class, \App\Repositories\Doctor\Setting\SettingRepository::class);
        $this->app->bind(\App\Interfaces\Doctor\Services\Setting\SettingServiceInterface::class, \App\Services\Doctor\Setting\SettingService::class);

        $this->app->bind(\App\Interfaces\Doctor\Repositories\Appointment\AppointmentRepositoryInterface::class, \App\Repositories\Doctor\Appointment\AppointmentRepository::class);
        $this->app->bind(\App\Interfaces\Doctor\Services\Appointment\AppointmentServiceInterface::class, \App\Services\Doctor\Appointment\AppointmentService::class);

        $this->app->bind(SymptomRepositoryInterface::class, SymptomRepository::class);
        $this->app->bind(SymptomServiceInterface::class, SymptomService::class);
        
        $this->app->bind(DiseaseRepositoryInterface::class, DiseaseRepository::class);
        $this->app->bind(DiseaseServiceInterface::class, DiseaseService::class);
        
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(AppointmentServiceInterface::class, AppointmentService::class);
        
        $this->app->bind(DaysOffRepositoryInterface::class, DaysOffRepository::class);
        $this->app->bind(DaysOffServiceInterface::class, DaysOffService::class);
        
        $this->app->bind(VacationRepositoryInterface::class, VacationRepository::class);
        $this->app->bind(VacationServiceInterface::class, VacationService::class);
        
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(ProfileServiceInterface::class, ProfileService::class);
        
        $this->app->bind(ProfileProfileRepositoryInterface::class, ProfileProfileRepository::class);
        $this->app->bind(ProfileProfileServiceInterface::class, ProfileProfileService::class);
        
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(ContactServiceInterface::class, ContactService::class);
        
        $this->app->bind(ContactContactRepositoryInterface::class, ContactContactRepository::class);
        $this->app->bind(ContactContactServiceInterface::class, ContactContactService::class);
        
        $this->app->bind(HomeRepositoryInterface::class, HomeRepository::class);
        $this->app->bind(HomeServiceInterface::class, HomeService::class);
    }
}
