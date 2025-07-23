<?php

namespace App\Interfaces\Doctor\Services\Vacation;

interface VacationServiceInterface
{
    //
    public function getAllVacations();
    public function storeVacation($data);
    public function updateVacation($data, $id);
    public function destroyVacation($id);
}
