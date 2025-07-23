<?php

namespace App\Repositories\Doctor\Setting;

use App\Interfaces\Doctor\Repositories\Setting\SettingRepositoryInterface;
use App\Models\Setting;

class SettingRepository implements SettingRepositoryInterface
{
    //
    public function updateSetting($data){
        return Setting::update([
            'about' => $data['about'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'facebook' => $data['facebook'],
            'whatsapp' => $data['whatsapp'],
            'daily_working_hours' => $data['daily_working_hours'],
            'daily_appointments_limit' => $data['daily_appointments_limit'],
            'appointment_duration' => $data['appointment_duration'],
        ]);
    }
}
