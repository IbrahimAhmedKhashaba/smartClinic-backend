<?php

namespace App\Services\patient\Appointment;

use App\Helpers\ApiResponse;
use App\Http\Resources\AppointmentResource;
use App\Interfaces\patient\Repositories\Appointment\AppointmentReositoryInterface;
use App\Interfaces\Patient\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Interfaces\Patient\Services\Appointment\AppointmentServiceInterface;
use Illuminate\Support\Facades\Auth;
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
            if (!$this->checkAppointmentPatient($Appointment)) {
                return ApiResponse::error("You don't have permission to access this appointment", 403);
            }
            return ApiResponse::success([
                'Appointment' => new AppointmentResource($Appointment),
            ], 'Appointment fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Appointment', 500);
        }
    }
    public function storeAppointment($data)
    {
        DB::beginTransaction();
        try {
            $appointment = $this->appointmentRepository->storeAppointment($data);

            $this->appointmentRepository->syncSymptoms($appointment, $data['symptoms'] ?? []);
            $this->appointmentRepository->syncOtherSymptoms($appointment, $data['other_symptoms'] ?? []);

            $this->appointmentRepository->syncDiseases($appointment, $data['diseases'] ?? []);
            $this->appointmentRepository->syncOtherDiseases($appointment, $data['other_diseases'] ?? []);

            $this->appointmentRepository->syncMedications($appointment, $data['medications'] ?? []);
            $this->appointmentRepository->syncDrugs($appointment, $data['drugs'] ?? []);

            DB::commit();
            return ApiResponse::success([
                'Appointment' => new AppointmentResource($appointment),
            ], 'Appointment created successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Error creating Appointment', 500);
        }
    }
    public function updateAppointment($id, $data)
    {
        DB::beginTransaction();
        try {
            $appointment = $this->appointmentRepository->getAppointmentById($id);
            if (!$this->checkAppointmentPatient($appointment)) {
                return ApiResponse::error("You don't have permission to access this appointment", 403);
            }
            $this->appointmentRepository->updateAppointment($appointment, $data);
            $this->appointmentRepository->syncSymptoms($appointment, $data['symptoms'] ?? []);
            $this->appointmentRepository->syncOtherSymptoms($appointment, $data['other_symptoms'] ?? []);
            $this->appointmentRepository->syncDiseases($appointment, $data['diseases'] ?? []);
            $this->appointmentRepository->syncOtherDiseases($appointment, $data['other_diseases'] ?? []);

            $this->appointmentRepository->syncMedications($appointment, $data['medications'] ?? []);
            $this->appointmentRepository->syncDrugs($appointment, $data['drugs'] ?? []);

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
            if (!$this->checkAppointmentPatient($Appointment)) {
                return ApiResponse::error("You don't have permission to access this appointment", 403);
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

    public function checkAppointmentPatient($appointment)
    {
        return $appointment->patient_id = Auth::guard('patient')->id() ? true : false;
    }
}
