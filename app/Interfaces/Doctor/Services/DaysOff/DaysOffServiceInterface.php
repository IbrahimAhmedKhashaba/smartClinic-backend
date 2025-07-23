<?php

namespace App\Interfaces\Doctor\Services\DaysOff;

interface DaysOffServiceInterface
{
    //
    public function getAllDaysOffs();
    public function storeDaysOff($data);
    public function updateDaysOff($data, $id);
    public function destroyDaysOff($id);
}
