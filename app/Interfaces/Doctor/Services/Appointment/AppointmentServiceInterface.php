<?php

namespace App\Interfaces\Doctor\Services\Appointment;

interface AppointmentServiceInterface
{
    //
    public function getAllAppointments();
    public function getAppointmentById($id);
    public function updateAppointmentStatus($id , $status);
    public function destroyAppointment($id);
    public function getAppointmentsByPatientId($patient_id);
    public function getWaitingAppointments();
    public function getCheckedAppointments();
    public function getLatedAppointments();
}
