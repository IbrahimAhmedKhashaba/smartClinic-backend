<?php

namespace App\Http\Controllers\Api\Doctor\Disease;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\Disease\DiseaseRequest;
use App\Interfaces\Doctor\Services\Disease\DiseaseServiceInterface;

class DiseaseController extends Controller
{
    //
    private $DiseaseService;
    public function __construct(DiseaseServiceInterface $DiseaseService)
    {
        $this->DiseaseService = $DiseaseService;
    }
    public function index()
    {
        return $this->DiseaseService->getAllDiseases();
    }
    public function show($id)
    {
        return $this->DiseaseService->getDiseaseById($id);
    }
    public function store(DiseaseRequest $request)
    {
        // Logic to create a new Disease
        return $this->DiseaseService->storeDisease($request->all());
    }
    public function update(DiseaseRequest $request, $id)
    {
        // Logic to update an existing Disease
        return $this->DiseaseService->updateDisease($id, $request->all());
    }
    public function destroy($id)
    {
        // Logic to delete a Disease
        return $this->DiseaseService->destroyDisease($id);
    }
}
