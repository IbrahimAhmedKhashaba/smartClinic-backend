<?php

namespace App\Interfaces\Doctor\Repositories\DaysOff;

interface DaysOffRepositoryInterface
{
    //
    public function getAllDaysOffs();
    public function getDaysOffById($id);
    public function storeDaysOff($data);
    public function updateDaysOff($daysOff , $data);
    public function destroyDaysOff($daysOff);
}
