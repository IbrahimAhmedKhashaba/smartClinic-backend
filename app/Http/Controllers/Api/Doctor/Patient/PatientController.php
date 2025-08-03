<?php

namespace App\Http\Controllers\Api\Doctor\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\Patient\PatientRequest;
use App\Interfaces\Doctor\Services\Patient\PatientServiceInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    private $PatientService;
    public function __construct(PatientServiceInterface $PatientService)
    {
        $this->PatientService = $PatientService;
    }
    public function index()
    {
        return $this->PatientService->getAllPatients();
    }
    public function show($id)
    {
        return $this->PatientService->getPatientById($id);
    }
    public function store(PatientRequest $request)
    {
        // Logic to update an existing Patient
        return $this->PatientService->storePatient( $request->all());
    }
    public function update(PatientRequest $request, $id)
    {
        // Logic to update an existing Patient
        return $this->PatientService->updatePatient($id, $request->all());
    }
    public function destroy($id)
    {
        // Logic to delete a Patient
        return $this->PatientService->destroyPatient($id);
    }

    
}
