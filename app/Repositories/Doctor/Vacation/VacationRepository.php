<?php

namespace App\Repositories\Doctor\Vacation;

use App\Interfaces\Doctor\Repositories\Vacation\VacationRepositoryInterface;
use App\Models\Vacation;

class VacationRepository implements VacationRepositoryInterface
{
    //
    public function getAllVacations()
    {
        return Vacation::select('id' , 'date')->get();
    }
    public function getVacationById($id)
    {
        return Vacation::select('id' , 'date')->find($id);
    }
    public function storeVacation($data)
    {
        $Vacation = new Vacation();
        $Vacation->date = $data['date'];
        $Vacation->save();
        return $Vacation;
    }
    public function updateVacation($Vacation, $data)
    {
        $Vacation->date = $data['date'] ?? $Vacation->date;
        $Vacation->save();
        return $Vacation;
    }
    public function destroyVacation($Vacation)
    {
        return $Vacation->delete();
    }
}
