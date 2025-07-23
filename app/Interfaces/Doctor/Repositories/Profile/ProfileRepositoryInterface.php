<?php

namespace App\Interfaces\Doctor\Repositories\Profile;

interface ProfileRepositoryInterface
{
    //
    public function getProfile();
    public function updateProfile($data);
    public function updatePassword($password);
}
