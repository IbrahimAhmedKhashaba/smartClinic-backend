<?php

namespace App\Interfaces\Doctor\Services\Patient;

interface PatientServiceInterface
{
    //
    public function getAllPatients();
    public function getPatientById($id);
    public function storePatient($data);
    public function updatePatient($id , $data);
    public function destroyPatient($id);
}
