<?php

namespace App\Repositories\Doctor\Appointment;

use App\Interfaces\Doctor\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Models\Appointment;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    //
    public function getAllAppointments()
    {
        return Appointment::with(
            'patient',
            'symptoms',
            'diseases',
            'other_symptoms',
            'other_diseases',
            'medications',
            'drugs',
        )->paginate(10);
    }
    public function getAppointmentById($id)
    {
        return Appointment::with(
            'patient',
            'symptoms',
            'diseases',
            'other_symptoms',
            'other_diseases',
            'medications',
            'drugs',
        )->find($id);
    }
    public function updateAppointmentStatus($appointment, $status)
    {
        $appointment->status = $status;
        $appointment->save();
        return $appointment;
    }
    public function destroyAppointment($appointment)
    {
        return $appointment->delete();
    }
    public function getAppointmentsByPatientId($patient_id)
    {
        return Appointment::where('patient_id', $patient_id)
            ->with(
                'patient',
                'symptoms',
                'diseases',
                'other_symptoms',
                'other_diseases',
                'medications',
                'drugs',
            )->paginate(10);
    }
    public function getWaitingAppointments()
    {
        return Appointment::where('status', 0)
            ->with(
                'patient',
                'symptoms',
                'diseases',
                'other_symptoms',
                'other_diseases',
                'medications',
                'drugs',
            )->paginate(10);
    }
    public function getCheckedAppointments()
    {
        return Appointment::where('status', 1)
            ->with(
                'patient',
                'symptoms',
                'diseases',
                'other_symptoms',
                'other_diseases',
                'medications',
                'drugs',
            )->paginate(10);
    }
    public function getLatedAppointments()
    {
        return Appointment::where('status', 2)
            ->with(
                'patient',
                'symptoms',
                'diseases',
                'other_symptoms',
                'other_diseases',
                'medications',
                'drugs',
            )->paginate(10);
    }
    public function incrementNumOfVisits($patient){
        $patient->num_of_visits++;
        return $patient->save();
    }
}
