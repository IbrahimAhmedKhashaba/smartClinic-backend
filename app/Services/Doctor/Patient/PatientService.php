<?php

namespace App\Services\Doctor\Patient;

use App\Helpers\ApiResponse;
use App\Http\Resources\PatientResource;
use App\Interfaces\Doctor\Repositories\Patient\PatientRepositoryInterface;
use App\Interfaces\Doctor\Services\Patient\PatientServiceInterface;
use Illuminate\Support\Facades\DB;

class PatientService implements PatientServiceInterface
{
    //
    private $PatientRepository;
    public function __construct(PatientRepositoryInterface $PatientRepository)
    {
        $this->PatientRepository = $PatientRepository;
    }

    public function getAllPatients()
    {
        try {
            $Patients = $this->PatientRepository->getAllPatients();
            return ApiResponse::success([
                'Patients' => PatientResource::collection($Patients),
                'meta' => [
                    'current_page' => $Patients->currentPage(),
                    'last_page' => $Patients->lastPage(),
                    'per_page' => $Patients->perPage(),
                    'total' => $Patients->total(),
                ],
                'links' => [
                    'next' => $Patients->nextPageUrl(),
                    'prev' => $Patients->previousPageUrl(),
                ]
            ], 'Patients fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Patients', 500);
        }
    }
    public function getPatientById($id)
    {
        try {
            $Patient = $this->PatientRepository->getPatientById($id);
            if (!$Patient) {
                return ApiResponse::error('Patient not found', 404);
            }
            return ApiResponse::success([
                'Patient' => new PatientResource($Patient),
            ], 'Patient fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Patient', 500);
        }
    }
    public function storePatient($data)
    {
        DB::beginTransaction();
        try {
            $Patient = $this->PatientRepository->storePatient($data);

            DB::commit();
            return ApiResponse::success([
                'Patient' => new PatientResource($Patient),
            ], 'Patient created successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Error created Patient', 500);
        }
    }
    public function updatePatient($id, $data)
    {
        DB::beginTransaction();
        try {
            $Patient = $this->PatientRepository->getPatientById($id);
            if(!$Patient){
                return ApiResponse::error('Patient not found', 404);
            }
            
            $this->PatientRepository->updatePatient($Patient, $data);
            $Patient->refresh();

            DB::commit();
            return ApiResponse::success([
                'Patient' => new PatientResource($Patient),
            ], 'Patient updated successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Error updating Patient', 500);
        }
    }
    public function destroyPatient($id)
    {
        try {
            $Patient = $this->PatientRepository->getPatientById($id);
            if (!$Patient) {
                return ApiResponse::error('Patient not found', 404);
            }
            $Patient = $this->PatientRepository->destroyPatient($Patient);
            if (!$Patient) {
                return ApiResponse::error('Error deleting Patient', 500);
            }
            return ApiResponse::success([], 'Patient deleted successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error deleting Patient', 500);
        }
    }
}
