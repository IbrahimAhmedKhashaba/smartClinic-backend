<?php

namespace App\Interfaces\Doctor\Services\Disease;

interface DiseaseServiceInterface
{
    //
    public function getAllDiseases();
    public function getDiseaseById($id);
    public function storeDisease($data);
    public function updateDisease($data, $id);
    public function destroyDisease($id);
}
