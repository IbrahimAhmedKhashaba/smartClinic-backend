<?php

namespace App\Services\Doctor\Setting;

use App\Interfaces\Doctor\Repositories\Setting\SettingRepositoryInterface;
use App\Interfaces\Doctor\Services\Setting\SettingServiceInterface;

class SettingService implements SettingServiceInterface
{
    //
    private $settingRepository;
    public function __construct(SettingRepositoryInterface $settingRepository){
        $this->settingRepository= $settingRepository;
    }
    public function updateSetting($data)
    {
        try{
            $setting = $this->settingRepository->updateSetting($data);
            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully',
                'data' => $setting,
            ], 200);
        } catch (\Exception $e) {
            // Handle exception
            return response()->json([
                'success' => false,
                'message' => 'Error updating settings: ' . $e->getMessage(),
            ], 500);
        }
    }
}
