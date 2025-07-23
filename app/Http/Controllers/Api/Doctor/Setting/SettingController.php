<?php

namespace App\Http\Controllers\Api\Doctor\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\Setting\SettingRequest;
use App\Interfaces\Doctor\Services\Setting\SettingServiceInterface;

class SettingController extends Controller
{
    //
    private $settingService;
    public function __construct(SettingServiceInterface $settingService)
    {
        $this->settingService = $settingService;
    }

    public function updateSetting(SettingRequest $request)
    {
        return $this->settingService->updateSetting($request->all());
    }
}
