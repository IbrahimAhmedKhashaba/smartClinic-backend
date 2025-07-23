<?php

namespace App\Http\Controllers\Api\Patient\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Profile\PasswordRequest;
use App\Http\Requests\Api\Patient\Profile\ProfileRequest;
use App\Interfaces\Patient\Services\Profile\ProfileServiceInterface;

class ProfileController extends Controller
{
    //
    private $profileService;
    public function __construct(ProfileServiceInterface $profileService){
        $this->profileService = $profileService;
    }
    public function getProfile(){
        return $this->profileService->getProfile();
    }
    public function updateProfile(ProfileRequest $request){
        return $this->profileService->updateProfile($request->all());
    }
    public function updatePassword(PasswordRequest $request){
        return $this->profileService->updatePassword($request->all());
    }
}
