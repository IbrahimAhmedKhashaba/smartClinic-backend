<?php

namespace App\Services\Doctor\Profile;

use App\Helpers\ApiResponse;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Interfaces\Doctor\Repositories\Profile\ProfileRepositoryInterface;
use App\Interfaces\Doctor\Services\Profile\ProfileServiceInterface;

class ProfileService implements ProfileServiceInterface
{
    //
    private $profileRepository;
    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function getProfile()
    {
        try {
            $profile = $this->profileRepository->getProfile();
            return ApiResponse::success([
                'Profiles' => new UserResource($profile),
            ], 'Profile fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Profiles', 500);
        }
    }

    public function updateProfile($data)
    {
        try {
            $Profile = $this->profileRepository->updateProfile($data);
            if (!$Profile) {
                return ApiResponse::error('Error updating Profile', 500);
            }
            return ApiResponse::success([
                'Profile' => new UserResource($Profile),
            ], 'Profile updated successfully', 200);
        } catch (\Exception $e) {
            return ApiResponse::error('Error updating Profile', 500);
        }
    }
    public function updatePassword($data)
    {
        try {

            $Profile = $this->profileRepository->updatePassword($data['password']);
            if (!$Profile) {
                return ApiResponse::error('Error updating password', 500);
            }
            return ApiResponse::success([], 'Password updated successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error updating password', 500);
        }
    }
}
