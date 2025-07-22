<?php

namespace App\Interfaces\Patient\Services\Appointment;

interface AppointmentServiceInterface
{
    //
    public function getAllAppointments();
    public function getAppointmentById($id);
    public function storeAppointment($data);
    public function updateAppointment($data, $id);
    public function destroyAppointment($id);
}
