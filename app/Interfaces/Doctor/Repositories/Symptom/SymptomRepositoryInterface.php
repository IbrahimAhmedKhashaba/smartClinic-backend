<?php

namespace App\Interfaces\Doctor\Repositories\Symptom;

interface SymptomRepositoryInterface
{
    //
    public function getAllSymptoms();
    public function getSymptomById($id);
    public function storeSymptom($data);
    public function updateSymptom($symptom , $data);
    public function destroySymptom($symptom);
}
