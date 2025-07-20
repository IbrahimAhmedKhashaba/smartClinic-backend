<?php

namespace App\Interfaces\Doctor\Repositories\Disease;

interface DiseaseRepositoryInterface
{
    //
    public function getAllDiseases();
    public function getDiseaseById($id);
    public function storeDisease($data);
    public function updateDisease($disease , $data);
    public function destroyDisease($disease);
}
