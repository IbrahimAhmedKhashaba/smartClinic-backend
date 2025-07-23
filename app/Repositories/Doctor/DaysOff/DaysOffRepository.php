<?php

namespace App\Repositories\Doctor\DaysOff;

use App\Interfaces\Doctor\Repositories\DaysOff\DaysOffRepositoryInterface;
use App\Models\DaysOff;

class DaysOffRepository implements DaysOffRepositoryInterface
{
    //
    public function getAllDaysOffs()
    {
        return DaysOff::select('id' , 'day')->get();
    }
    public function getDaysOffById($id)
    {
        return DaysOff::select('id' , 'day')->find($id);
    }
    public function storeDaysOff($data)
    {
        $DaysOff = new DaysOff();
        $DaysOff->day = $data['day'];
        $DaysOff->save();
        return $DaysOff;
    }
    public function updateDaysOff($DaysOff, $data)
    {
        $DaysOff->day = $data['day'] ?? $DaysOff->day;
        $DaysOff->save();
        return $DaysOff;
    }
    public function destroyDaysOff($DaysOff)
    {
        return $DaysOff->delete();
    }
}
