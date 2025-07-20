<?php

namespace App\Repositories\Doctor\Symptom;

use App\Interfaces\Doctor\Repositories\Symptom\SymptomRepositoryInterface;
use App\Models\Symptom;

class SymptomRepository implements SymptomRepositoryInterface
{
    //
    public function getAllSymptoms()
    {
        return Symptom::select('id' , 'name')->get();
    }
    public function getSymptomById($id)
    {
        return Symptom::select('id' , 'name')->findOrFail($id);
    }
    public function storeSymptom($data)
    {
        $symptom = new Symptom();
        $symptom->name = $data['name'];
        $symptom->save();
        return $symptom;
    }
    public function updateSymptom($symptom, $data)
    {
        $symptom->name = $data['name'];
        $symptom->save();
        return $symptom;
    }
    public function destroySymptom($symptom)
    {
        return $symptom->delete();
    }
}
