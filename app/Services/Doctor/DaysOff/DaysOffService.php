<?php

namespace App\Services\Doctor\DaysOff;

use App\Helpers\ApiResponse;
use App\Http\Resources\DaysOffResource;
use App\Interfaces\Doctor\Repositories\DaysOff\DaysOffRepositoryInterface;
use App\Interfaces\Doctor\Services\DaysOff\DaysOffServiceInterface;

class DaysOffService implements DaysOffServiceInterface
{
    //
    private $DaysOffRepository;
    public function __construct(DaysOffRepositoryInterface $DaysOffRepository)
    {
        $this->DaysOffRepository = $DaysOffRepository;
    }

    public function getAllDaysOffs(){
        try{
            $DaysOffs = $this->DaysOffRepository->getAllDaysOffs();
            return ApiResponse::success([
                'DaysOffs' => DaysOffResource::collection($DaysOffs),
            ], 'DaysOffs fetched successfully' , 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching DaysOffs', 500);
        }
    }
    public function storeDaysOff($data){
        try{
            $DaysOff = $this->DaysOffRepository->storeDaysOff($data);
            return ApiResponse::success([
                'DaysOff' => new DaysOffResource($DaysOff),
            ], 'DaysOff created successfully', 201);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error creating DaysOff', 500);
        }
    }
    public function updateDaysOff($id , $data){
        try{
            $DaysOff = $this->DaysOffRepository->getDaysOffById($id);
            if(!$DaysOff) {
                return ApiResponse::error('DaysOff not found', 404);
            }
            $DaysOff = $this->DaysOffRepository->updateDaysOff($DaysOff, $data);
            if(!$DaysOff) {
                return ApiResponse::error('Error updating DaysOff', 500);
            }
            return ApiResponse::success([
                'DaysOff' => new DaysOffResource($DaysOff),
            ], 'DaysOff updated successfully', 200);
        } catch (\Exception $e) {
            return ApiResponse::error('Error updating DaysOff', 500);
        }
    }
    public function destroyDaysOff($id){
        try{
            $DaysOff = $this->DaysOffRepository->getDaysOffById($id);
            if(!$DaysOff) {
                return ApiResponse::error('DaysOff not found', 404);
            }
            $DaysOff = $this->DaysOffRepository->destroyDaysOff($DaysOff);
            if(!$DaysOff) {
                return ApiResponse::error('Error deleting DaysOff', 500);
            }
            return ApiResponse::success([], 'DaysOff deleted successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error deleting DaysOff', 500);
        }
    }
}
