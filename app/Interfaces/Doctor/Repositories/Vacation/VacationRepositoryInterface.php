<?php

namespace App\Interfaces\Doctor\Repositories\Vacation;

interface VacationRepositoryInterface
{
    //
    public function getAllVacations();
    public function getVacationById($id);
    public function storeVacation($data);
    public function updateVacation($vacation , $data);
    public function destroyVacation($vacation);
}
