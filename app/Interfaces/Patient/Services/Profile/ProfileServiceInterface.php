<?php

namespace App\Interfaces\Patient\Services\Profile;

interface ProfileServiceInterface
{
    //
    public function getProfile();
    public function updateProfile($data);
    public function updatePassword($data);
}
