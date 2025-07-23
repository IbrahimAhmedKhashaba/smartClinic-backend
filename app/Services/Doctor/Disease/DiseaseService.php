<?php

namespace App\Services\Doctor\Disease;

use App\Helpers\ApiResponse;
use App\Http\Resources\GeneralResource;
use App\Interfaces\Doctor\Repositories\Disease\DiseaseRepositoryInterface;
use App\Interfaces\Doctor\Services\Disease\DiseaseServiceInterface;

class DiseaseService implements DiseaseServiceInterface
{
    //
    private $DiseaseRepository;
    public function __construct(DiseaseRepositoryInterface $DiseaseRepository)
    {
        $this->DiseaseRepository = $DiseaseRepository;
    }

    public function getAllDiseases(){
        try{
            $Diseases = $this->DiseaseRepository->getAllDiseases();
            return ApiResponse::success([
                'Diseases' => GeneralResource::collection($Diseases),
            ], 'Diseases fetched successfully' , 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Diseases', 500);
        }
    }
    public function getDiseaseById($id){
        try{
            $Disease = $this->DiseaseRepository->getDiseaseById($id);
            if(!$Disease) {
                return ApiResponse::error('Disease not found', 404);
            }
            return ApiResponse::success([
                'Disease' => new GeneralResource($Disease),
            ], 'Disease fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Disease', 500);
        }
    }
    public function storeDisease($data){
        try{
            $Disease = $this->DiseaseRepository->storeDisease($data);
            return ApiResponse::success([
                'Disease' => new GeneralResource($Disease),
            ], 'Disease created successfully', 201);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error creating Disease', 500);
        }
    }
    public function updateDisease($id , $data){
        try{
            $Disease = $this->DiseaseRepository->getDiseaseById($id);
            if(!$Disease) {
                return ApiResponse::error('Disease not found', 404);
            }
            $Disease = $this->DiseaseRepository->updateDisease($Disease, $data);
            if(!$Disease) {
                return ApiResponse::error('Error updating Disease', 500);
            }
            return ApiResponse::success([
                'Disease' => new GeneralResource($Disease),
            ], 'Disease updated successfully', 200);
        } catch (\Exception $e) {
            return ApiResponse::error('Error updating Disease', 500);
        }
    }
    public function destroyDisease($id){
        try{
            $Disease = $this->DiseaseRepository->getDiseaseById($id);
            if(!$Disease) {
                return ApiResponse::error('Disease not found', 404);
            }
            $Disease = $this->DiseaseRepository->destroyDisease($Disease);
            if(!$Disease) {
                return ApiResponse::error('Error deleting Disease', 500);
            }
            return ApiResponse::success([], 'Disease deleted successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error deleting Disease', 500);
        }
    }
}
