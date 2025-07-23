<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Setting::firstOrCreate([
            'about' => [
                'en' => 'We are a leading healthcare provider dedicated to delivering exceptional medical services and patient care.',
                'ar' => 'نحن مزود رعاية صحية رائد ملتزم بتقديم خدمات طبية ورعاية مرضى استثنائية.',
            ],
            'email' => 'smart@clinic.com',
            'phone' => '+201124782711',
            'address' => [
                'en' => '123 Health St, Cairo, Egypt',
                'ar' => '123 شارع الصحة، القاهرة، مصر',
            ],
            'facebook' => 'https://www.facebook.com/smartclinic',
            'whatsapp' => '+201124782711',

            'open_time' => '9:00 AM',
            'close_time' => '5:00 PM',
            'daily_appointments_limit' => '20',
            'appointment_duration' => '20',
        ]);
    }
}
