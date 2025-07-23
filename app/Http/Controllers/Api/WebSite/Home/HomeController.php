<?php

namespace App\Http\Controllers\Api\WebSite\Home;

use App\Http\Controllers\Controller;
use App\Interfaces\WebSite\Services\Home\HomeServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $homeService;
    public function __construct(HomeServiceInterface $homeService){
        $this->homeService = $homeService;
    }
    public function __invoke(Request $request)
    {
        //
        return $this->homeService->index();
    }
}
