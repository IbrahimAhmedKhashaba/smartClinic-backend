<?php

namespace App\Services\Doctor\Vacation;

use App\Helpers\ApiResponse;
use App\Http\Resources\VacationResource;
use App\Interfaces\Doctor\Repositories\Vacation\VacationRepositoryInterface;
use App\Interfaces\Doctor\Services\Vacation\VacationServiceInterface;

class VacationService implements VacationServiceInterface
{
    //
    private $VacationRepository;
    public function __construct(VacationRepositoryInterface $VacationRepository)
    {
        $this->VacationRepository = $VacationRepository;
    }

    public function getAllVacations()
    {
        try {
            $Vacations = $this->VacationRepository->getAllVacations();
            return ApiResponse::success([
                'Vacations' => VacationResource::collection($Vacations),
            ], 'Vacations fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Vacations', 500);
        }
    }
    public function storeVacation($data)
    {
        try {
            $Vacation = $this->VacationRepository->storeVacation($data);
            return ApiResponse::success([
                'Vacation' => new VacationResource($Vacation),
            ], 'Vacation created successfully', 201);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error creating Vacation', 500);
        }
    }
    public function updateVacation($id, $data)
    {
        try {
            $Vacation = $this->VacationRepository->getVacationById($id);
            if (!$Vacation) {
                return ApiResponse::error('Vacation not found', 404);
            }
            $Vacation = $this->VacationRepository->updateVacation($Vacation, $data);
            if (!$Vacation) {
                return ApiResponse::error('Error updating Vacation', 500);
            }
            return ApiResponse::success([
                'Vacation' => new VacationResource($Vacation),
            ], 'Vacation updated successfully', 200);
        } catch (\Exception $e) {
            return ApiResponse::error('Error updating Vacation', 500);
        }
    }
    public function destroyVacation($id)
    {
        try {
            $Vacation = $this->VacationRepository->getVacationById($id);
            if (!$Vacation) {
                return ApiResponse::error('Vacation not found', 404);
            }
            $Vacation = $this->VacationRepository->destroyVacation($Vacation);
            if (!$Vacation) {
                return ApiResponse::error('Error deleting Vacation', 500);
            }
            return ApiResponse::success([], 'Vacation deleted successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error deleting Vacation', 500);
        }
    }
}
