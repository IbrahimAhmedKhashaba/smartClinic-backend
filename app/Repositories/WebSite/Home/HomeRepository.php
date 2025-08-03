<?php

namespace App\Repositories\WebSite\Home;

use App\Interfaces\WebSite\Repositories\Home\HomeRepositoryInterface;
use App\Models\Appointment;
use App\Models\DaysOff;
use App\Models\Home;
use App\Models\Setting;
use App\Models\Vacation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function getCompletedDays()
    {
        $limit = DB::table('settings')->value('daily_appointments_limit');
        return DB::table('appointments')
            ->select('date', DB::raw('COUNT(*) as total_bookings'))
            ->whereDate('date', '>=', Carbon::today())
            ->groupBy('date')
            ->having('total_bookings', '>=', $limit)
            ->pluck('date');
    }
}
