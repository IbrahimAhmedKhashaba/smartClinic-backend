<?php

namespace App\Repositories\Doctor\Profile;

use App\Interfaces\Doctor\Repositories\Profile\ProfileRepositoryInterface;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileRepository implements ProfileRepositoryInterface
{
    //
    public function getProfile()
    {
        return User::where( 'id', Auth::id())->first();
    }
    public function updateProfile($data)
    {
        User::whereId(Auth::id())->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        return Auth::user();
    }
    public function updatePassword($password)
    {
        return User::whereId(Auth::id())->update([
            'password' => Hash::make($password)
        ]);
    }
}
