<?php

namespace App\Services\WebSite\Home;

use App\Helpers\ApiResponse;
use App\Http\Resources\Doctor\SettingResource;
use App\Interfaces\WebSite\Repositories\Home\HomeRepositoryInterface;
use App\Interfaces\WebSite\Services\Home\HomeServiceInterface;
use Illuminate\Support\Facades\Auth;

class HomeService implements HomeServiceInterface
{
    private $homeRepository;
    public function __construct(HomeRepositoryInterface $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }
    public function index(){
        try{
            $settings = $this->homeRepository->getSettings();
            $daysOff = $this->homeRepository->getDaysOffs();
            $Vacations = $this->homeRepository->getVacations();
            return ApiResponse::success([
                'settings' => new SettingResource($settings),
                 'daysOff' => $daysOff,
                 'Vacations' => $Vacations,
            ] , 'Home Data Fetched successfully' , 200);
        } catch(\Exception $e){
            return ApiResponse::error('Internal Error' , 500);
        }
    }
}