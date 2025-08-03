<?php

namespace App\Repositories\Doctor\Patient;

use App\Interfaces\Doctor\Repositories\Patient\PatientRepositoryInterface;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientRepositoryInterface
{
    //
    public function getAllPatients()
    {
        return Patient::paginate(10);
    }
    public function getPatientById($id)
    {
        return Patient::find($id);
    }
    public function storePatient($data)
    {
        return Patient::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'age' => $data['age'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
        ]);
    }
    public function updatePatient($patient, $data)
    {
        return $patient->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'age' => $data['age'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
        ]);
    }
    public function destroyPatient($Patient)
    {
        return $Patient->delete();
    }
}
