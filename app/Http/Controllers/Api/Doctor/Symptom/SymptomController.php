<?php

namespace App\Http\Controllers\Api\Doctor\Symptom;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\Symptom\SymptomRequest;
use App\Interfaces\Doctor\Services\Symptom\SymptomServiceInterface;

class SymptomController extends Controller
{
    //
    private $symptomService;
    public function __construct(SymptomServiceInterface $symptomService)
    {
        $this->symptomService = $symptomService;
    }
    public function index()
    {
        return $this->symptomService->getAllSymptoms();
    }
    public function show($id)
    {
        return $this->symptomService->getSymptomById($id);
    }
    public function store(SymptomRequest $request)
    {
        // Logic to create a new symptom
        return $this->symptomService->storeSymptom($request->all());
    }
    public function update(SymptomRequest $request, $id)
    {
        // Logic to update an existing symptom
        return $this->symptomService->updateSymptom($id, $request->all());
    }
    public function destroy($id)
    {
        // Logic to delete a symptom
        return $this->symptomService->destroySymptom($id);
    }
}
