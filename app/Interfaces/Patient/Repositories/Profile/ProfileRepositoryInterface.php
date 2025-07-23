<?php

namespace App\Interfaces\Patient\Repositories\Profile;

interface ProfileRepositoryInterface
{
    //
    public function getProfile();
    public function updateProfile($data);
    public function updatePassword($password);
}
