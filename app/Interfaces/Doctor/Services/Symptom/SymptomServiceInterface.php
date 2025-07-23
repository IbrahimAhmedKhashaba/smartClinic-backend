<?php

namespace App\Interfaces\Doctor\Services\Symptom;

interface SymptomServiceInterface
{
    //
    public function getAllSymptoms();
    public function storeSymptom($data);
    public function updateSymptom($data, $id);
    public function destroySymptom($id);
}
