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
        // Logic to return a list of symptoms
    }
    public function show($id)
    {
        // Logic to return a specific symptom by ID
    }
    public function store(SymptomRequest $request)
    {
        // Logic to create a new symptom
    }
    public function update(SymptomRequest $request, $id)
    {
        // Logic to update an existing symptom
    }
    public function destroy($id)
    {
        // Logic to delete a symptom
    }
}
