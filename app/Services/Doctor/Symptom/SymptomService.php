<?php

namespace App\Services\Doctor\Symptom;

use App\Helpers\ApiResponse;
use App\Http\Resources\GeneralResource;
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
        try{
            $symptoms = $this->symptomRepository->getAllSymptoms();
            return ApiResponse::success([
                'symptoms' => GeneralResource::collection($symptoms),
            ], 'Symptoms fetched successfully' , 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching symptoms', 500);
        }
    }
    public function getSymptomById($id){
        try{
            $symptom = $this->symptomRepository->getSymptomById($id);
            if(!$symptom) {
                return ApiResponse::error('Symptom not found', 404);
            }
            return ApiResponse::success([
                'symptom' => new GeneralResource($symptom),
            ], 'Symptom fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching symptom', 500);
        }
    }
    public function storeSymptom($data){
        try{
            $symptom = $this->symptomRepository->storeSymptom($data);
            return ApiResponse::success([
                'symptom' => new GeneralResource($symptom),
            ], 'Symptom created successfully', 201);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error creating symptom', 500);
        }
    }
    public function updateSymptom($id , $data){
        try{
            $symptom = $this->symptomRepository->getSymptomById($id);
            if(!$symptom) {
                return ApiResponse::error('Symptom not found', 404);
            }
            $symptom = $this->symptomRepository->updateSymptom($symptom, $data);
            if(!$symptom) {
                return ApiResponse::error('Error updating symptom', 500);
            }
            return ApiResponse::success([
                'symptom' => new GeneralResource($symptom),
            ], 'Symptom updated successfully', 200);
        } catch (\Exception $e) {
            return ApiResponse::error('Error updating symptom', 500);
        }
    }
    public function destroySymptom($id){
        try{
            $symptom = $this->symptomRepository->getSymptomById($id);
            if(!$symptom) {
                return ApiResponse::error('Symptom not found', 404);
            }
            $symptom = $this->symptomRepository->destroySymptom($symptom);
            if(!$symptom) {
                return ApiResponse::error('Error deleting symptom', 500);
            }
            return ApiResponse::success([], 'Symptom deleted successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error deleting symptom', 500);
        }
    }
}
