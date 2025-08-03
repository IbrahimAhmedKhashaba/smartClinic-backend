<?php

namespace App\Interfaces\Doctor\Repositories\Patient;

interface PatientRepositoryInterface
{
    //
    public function getAllPatients();
    public function getPatientById($id);
    public function storePatient($data);
    public function updatePatient($Patient , $data);
    public function destroyPatient($Patient);

}
