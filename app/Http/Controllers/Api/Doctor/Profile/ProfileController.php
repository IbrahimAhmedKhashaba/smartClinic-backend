<?php

namespace App\Http\Controllers\Api\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\PasswordRequest;
use App\Http\Requests\Doctor\ProfileRequest;
use App\Interfaces\Doctor\Services\Profile\ProfileServiceInterface;
use Illuminate\Http\Request;

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
