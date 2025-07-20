<?php

namespace App\Repositories\Doctor\Symptom;

use App\Interfaces\Doctor\Repositories\Symptom\SymptomRepositoryInterface;

class SymptomRepository implements SymptomRepositoryInterface
{
    //
    public function getAllSymptoms(){}
    public function getSymptomById($id){}
    public function storeSymptom($data){}
    public function updateSymptom($data, $id){}
    public function destroySymptom($id){}
}
