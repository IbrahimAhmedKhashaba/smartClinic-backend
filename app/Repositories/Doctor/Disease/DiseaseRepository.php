<?php

namespace App\Repositories\Doctor\Disease;

use App\Interfaces\Doctor\Repositories\Disease\DiseaseRepositoryInterface;
use App\Models\Disease;

class DiseaseRepository implements DiseaseRepositoryInterface
{
    //
    public function getAllDiseases()
    {
        return Disease::select('id' , 'name')->get();
    }
    public function getDiseaseById($id)
    {
        return Disease::select('id' , 'name')->find($id);
    }
    public function storeDisease($data)
    {
        $Disease = new Disease();
        $Disease->name = $data['name'];
        $Disease->save();
        return $Disease;
    }
    public function updateDisease($Disease, $data)
    {
        $Disease->name = $data['name'];
        $Disease->save();
        return $Disease;
    }
    public function destroyDisease($Disease)
    {
        return $Disease->delete();
    }
}
