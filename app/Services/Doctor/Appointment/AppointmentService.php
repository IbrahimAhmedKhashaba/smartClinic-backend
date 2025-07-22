<?php

namespace App\Services\Doctor\Appointment;

use App\Helpers\ApiResponse;
use App\Http\Resources\AppointmentResource;
use App\Interfaces\Doctor\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Interfaces\Doctor\Services\Appointment\AppointmentServiceInterface;
use Illuminate\Support\Facades\DB;

class AppointmentService implements AppointmentServiceInterface
{
    //
    private $appointmentRepository;
    public function __construct(AppointmentRepositoryInterface $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function getAllAppointments()
    {
        try {
            $Appointments = $this->appointmentRepository->getAllAppointments();
            return ApiResponse::success([
                'Appointments' => AppointmentResource::collection($Appointments),
                'meta' => [
                    'current_page' => $Appointments->currentPage(),
                    'last_page' => $Appointments->lastPage(),
                    'per_page' => $Appointments->perPage(),
                    'total' => $Appointments->total(),
                ],
                'links' => [
                    'next' => $Appointments->nextPageUrl(),
                    'prev' => $Appointments->previousPageUrl(),
                ]
            ], 'Appointments fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Appointments', 500);
        }
    }
    public function getAppointmentById($id)
    {
        try {
            $Appointment = $this->appointmentRepository->getAppointmentById($id);
            if (!$Appointment) {
                return ApiResponse::error('Appointment not found', 404);
            }
            return ApiResponse::success([
                'Appointment' => new AppointmentResource($Appointment),
            ], 'Appointment fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Appointment', 500);
        }
    }
    public function updateAppointmentStatus($id, $data)
    {
        DB::beginTransaction();
        try {
            $appointment = $this->appointmentRepository->getAppointmentById($id);
            $this->appointmentRepository->updateAppointmentStatus($appointment, $data['status']);
            
            DB::commit();
            return ApiResponse::success([
                'Appointment' => new AppointmentResource($appointment),
            ], 'Appointment updated successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Error updating Appointment', 500);
        }
    }
    public function destroyAppointment($id)
    {
        try {
            $Appointment = $this->appointmentRepository->getAppointmentById($id);
            if (!$Appointment) {
                return ApiResponse::error('Appointment not found', 404);
            }
            $Appointment = $this->appointmentRepository->destroyAppointment($Appointment);
            if (!$Appointment) {
                return ApiResponse::error('Error deleting Appointment', 500);
            }
            return ApiResponse::success([], 'Appointment deleted successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error deleting Appointment', 500);
        }
    }
    public function getAppointmentsByPatientId($patient_id){
        try {
            $Appointments = $this->appointmentRepository->getAppointmentsByPatientId($patient_id);
            return ApiResponse::success([
                'Appointments' => AppointmentResource::collection($Appointments),
                'meta' => [
                    'current_page' => $Appointments->currentPage(),
                    'last_page' => $Appointments->lastPage(),
                    'per_page' => $Appointments->perPage(),
                    'total' => $Appointments->total(),
                ],
                'links' => [
                    'next' => $Appointments->nextPageUrl(),
                    'prev' => $Appointments->previousPageUrl(),
                ]
            ], 'Appointments fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Appointments', 500);
        }
    }
    public function getWaitingAppointments(){
        try {
            $Appointments = $this->appointmentRepository->getWaitingAppointments();
            return ApiResponse::success([
                'Appointments' => AppointmentResource::collection($Appointments),
                'meta' => [
                    'current_page' => $Appointments->currentPage(),
                    'last_page' => $Appointments->lastPage(),
                    'per_page' => $Appointments->perPage(),
                    'total' => $Appointments->total(),
                ],
                'links' => [
                    'next' => $Appointments->nextPageUrl(),
                    'prev' => $Appointments->previousPageUrl(),
                ]
            ], 'Appointments fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Appointments', 500);
        }
    }
    public function getCheckedAppointments(){
        try {
            $Appointments = $this->appointmentRepository->getCheckedAppointments();
            return ApiResponse::success([
                'Appointments' => AppointmentResource::collection($Appointments),
                'meta' => [
                    'current_page' => $Appointments->currentPage(),
                    'last_page' => $Appointments->lastPage(),
                    'per_page' => $Appointments->perPage(),
                    'total' => $Appointments->total(),
                ],
                'links' => [
                    'next' => $Appointments->nextPageUrl(),
                    'prev' => $Appointments->previousPageUrl(),
                ]
            ], 'Appointments fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Appointments', 500);
        }
    }
    public function getLatedAppointments(){
        try {
            $Appointments = $this->appointmentRepository->getLatedAppointments();
            return ApiResponse::success([
                'Appointments' => AppointmentResource::collection($Appointments),
                'meta' => [
                    'current_page' => $Appointments->currentPage(),
                    'last_page' => $Appointments->lastPage(),
                    'per_page' => $Appointments->perPage(),
                    'total' => $Appointments->total(),
                ],
                'links' => [
                    'next' => $Appointments->nextPageUrl(),
                    'prev' => $Appointments->previousPageUrl(),
                ]
            ], 'Appointments fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Appointments', 500);
        }
    }
}
