<?php

namespace App\Repositories\Patient\Appointment;

use App\Interfaces\Patient\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

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
        )->where('patient_id', Auth::id())
        ->paginate(10);
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
        )->where('patient_id', Auth::id())
        ->find($id);
    }
    public function storeAppointment($data)
    {
        $appointment = new Appointment();
        $appointment->patient_id = Auth::guard('patient')->id();
        $appointment->symptoms_duration = $data['symptoms_duration'];
        $appointment->save();
        return $appointment;
    }
    public function updateAppointment($appointment, $data)
    {
        $appointment->symptoms_duration = $data['symptoms_duration'] ?? $appointment['symptoms_duration'];
        $appointment->save();
        return $appointment;
    }
    public function destroyAppointment($Appointment)
    {
        return $Appointment->delete();
    }

    public function getAppointmentsByPatientId($patientId)
    {
        return Appointment::where('patient_id', $patientId)
            ->with(
                'patient',
                'symptoms',
                'diseases',
                'other_symptoms',
                'other_diseases',
                'medications',
                'drugs'
            )->paginate(10);
    }

    public function syncSymptoms($appointment, $symptoms)
    {
        $appointment->symptoms()->delete();
        if (filled($symptoms)) {
            $appointment->symptoms()->sync($symptoms);
        }
    }

    public function syncDiseases($appointment, $diseases)
    {
        $appointment->diseases()->delete();
        if (filled($diseases)) {
            $appointment->diseases()->sync($diseases);
        }
    }

    public function syncOtherSymptoms($appointment, $otherSymptoms)
    {
        $appointment->other_symptoms()->delete();

        if (filled($otherSymptoms)) {
            foreach ($otherSymptoms as $symptomName) {
                $appointment->other_symptoms()->create([
                    'name' => $symptomName
                ]);
            }
        }
    }

    public function syncOtherDiseases($appointment, $otherDiseases)
    {
        $appointment->other_diseases()->delete();

        if (filled($otherDiseases)) {
            foreach ($otherDiseases as $diseaseName) {
                $appointment->other_diseases()->create([
                    'name' => $diseaseName
                ]);
            }
        }
    }

    public function syncMedications($appointment, $medications)
    {
        $appointment->medications()->delete();

        if (filled($medications)) {
            foreach ($medications as $medicationName) {
                $appointment->medications()->create([
                    'name' => $medicationName
                ]);
            }
        }
    }

    public function syncDrugs($appointment, $drugs)
    {
        $appointment->drugs()->delete();

        if (filled($drugs)) {
            foreach ($drugs as $drugName) {
                $appointment->drugs()->create([
                    'name' => $drugName
                ]);
            }
        }
    }
}
