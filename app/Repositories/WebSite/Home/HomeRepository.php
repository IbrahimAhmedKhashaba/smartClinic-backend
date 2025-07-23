<?php

namespace App\Repositories\WebSite\Home;

use App\Interfaces\WebSite\Repositories\Home\HomeRepositoryInterface;
use App\Models\DaysOff;
use App\Models\Home;
use App\Models\Setting;
use App\Models\Vacation;

class HomeRepository implements HomeRepositoryInterface
{
    public function getSettings()
    {
        return Setting::select([
            'about',
            'email',
            'phone',
            'address',
            'facebook',
            'whatsapp'
        ])->first();
    }
    public function getDaysOffs()
    {
        return DaysOff::get()->map(function ($item) {
            $item->day = $item->getTranslation('day', 'en');
            return $item->day;
        });
    }
    public function getVacations()
    {
        return Vacation::pluck('date');
    }
}
