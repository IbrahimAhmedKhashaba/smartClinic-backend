<?php

namespace App\Http\Controllers\Api\Doctor\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\Appointment\AppointmentRequest;
use App\Interfaces\Doctor\Services\Appointment\AppointmentServiceInterface;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    private $appointmentService;
    public function __construct(AppointmentServiceInterface $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }
    public function index()
    {
        return $this->appointmentService->getAllAppointments();
    }
    public function show($id)
    {
        return $this->appointmentService->getAppointmentById($id);
    }
    public function update(AppointmentRequest $request, $id)
    {
        // Logic to update an existing Appointment
        return $this->appointmentService->updateAppointmentStatus($id, $request->all());
    }
    public function destroy($id)
    {
        // Logic to delete a Appointment
        return $this->appointmentService->destroyAppointment($id);
    }

    public function getAppointmentsByPatientId($patient_id)
    {
        return $this->appointmentService->getAppointmentsByPatientId($patient_id);
    }

    public function getWaitingAppointments()
    {
        return $this->appointmentService->getWaitingAppointments();
    }

    public function getCheckedAppointments()
    {
        return $this->appointmentService->getCheckedAppointments();
    }

    public function getLatedAppointments()
    {
        return $this->appointmentService->getLatedAppointments();
    }
}
