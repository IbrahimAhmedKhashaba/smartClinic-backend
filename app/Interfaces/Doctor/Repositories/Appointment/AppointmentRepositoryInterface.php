<?php

namespace App\Interfaces\Doctor\Repositories\Appointment;

interface AppointmentRepositoryInterface
{
    //
    public function getAllAppointments();
    public function getAppointmentById($id);
    public function updateAppointmentStatus($appointment , $status);
    public function destroyAppointment($appointment);
    public function getAppointmentsByPatientId($patient_id);
    public function getWaitingAppointments();
    public function getCheckedAppointments();
    public function getLatedAppointments();
    public function incrementNumOfVisits($patient);
}
