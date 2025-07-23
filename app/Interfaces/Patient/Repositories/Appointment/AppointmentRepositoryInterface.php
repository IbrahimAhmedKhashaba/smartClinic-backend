<?php

namespace App\Interfaces\Patient\Repositories\Appointment;

interface AppointmentRepositoryInterface
{
    //
    public function getAllAppointments();
    public function getAppointmentById($id);
    public function storeAppointment($data);
    public function updateAppointment($appointment , $data);
    public function destroyAppointment($appointment);

    public function getAppointmentsByPatientId($patient_id);

    public function syncSymptoms($appointment, $symptoms);

    public function syncDiseases($appointment, $diseases);

    public function syncOtherSymptoms($appointment, $otherSymptoms);

    public function syncOtherDiseases($appointment, $otherDiseases);

    public function syncMedications($appointment, $medications);

    public function syncDrugs($appointment, $drugs);

    public function checkDaysOff($dayNameEn);
    public function checkVacation($date);
    public function getAppointmentsCount($date);
    public function getSettings();
}
