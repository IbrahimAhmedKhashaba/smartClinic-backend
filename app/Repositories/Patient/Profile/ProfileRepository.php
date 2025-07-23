<?php

namespace App\Repositories\Patient\Profile;

use App\Interfaces\Patient\Repositories\Profile\ProfileRepositoryInterface;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileRepository implements ProfileRepositoryInterface
{
    //
    public function getProfile()
    {
        return Patient::where( 'id', Auth::guard('patient')->id())->first();
    }
    public function updateProfile($data)
    {
        $patient = Patient::whereId(Auth::guard('patient')->id())->first();
            $patient->name = $data['name'];
            $patient->email = $data['email'];
            $patient->phone = $data['phone'];
            $patient->age = $data['age'];
            $patient->address = $data['address'];
            $patient->gender = $data['gender'];
            $patient->save();

        return Auth::guard('patient')->user();
    }
    public function updatePassword($password)
    {
        return Patient::whereId(Auth::guard('patient')->id())->update([
            'password' => Hash::make($password)
        ]);
    }
}
