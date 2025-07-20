<?php

namespace App\Services\Doctor\Symptom;

use App\Interfaces\Doctor\Repositories\Symptom\SymptomRepositoryInterface;
use App\Interfaces\Doctor\Services\Symptom\SymptomServiceInterface;

class SymptomService implements SymptomServiceInterface
{
    //
    private $symptomRepository;
    public function __construct(SymptomRepositoryInterface $symptomRepository)
    {
        $this->symptomRepository = $symptomRepository;
    }

    public function getAllSymptoms(){
        
    }
    public function getSymptomById($id){
        
    }
    public function storeSymptom($data){
        
    }
    public function updateSymptom($data, $id){
        
    }
    public function destroySymptom($id){
        
    }
}
