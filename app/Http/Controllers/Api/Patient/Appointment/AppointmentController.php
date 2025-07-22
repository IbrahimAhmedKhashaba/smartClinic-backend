<?php

namespace App\Http\Controllers\Api\Patient\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Appointment\AppointmentRequest;
use App\Interfaces\Patient\Services\Appointment\AppointmentServiceInterface;

class AppointmentController extends Controller
{
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
    public function store(AppointmentRequest $request)
    {
        // Logic to create a new Appointment
        return $this->appointmentService->storeAppointment($request->all());
    }
    public function update(AppointmentRequest $request, $id)
    {
        // Logic to update an existing Appointment
        return $this->appointmentService->updateAppointment($id, $request->all());
    }
    public function destroy($id)
    {
        // Logic to delete a Appointment
        return $this->appointmentService->destroyAppointment($id);
    }
}
