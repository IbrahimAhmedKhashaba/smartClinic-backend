<?php

namespace App\Http\Controllers\Api\Doctor\DaysOff;

use App\Http\Controllers\Controller;
use App\Http\Requests\DaysOffRequest;
use App\Interfaces\Doctor\Services\DaysOff\DaysOffServiceInterface;

class DaysOffController extends Controller
{
    //
    private $DaysOffService;
    public function __construct(DaysOffServiceInterface $DaysOffService)
    {
        $this->DaysOffService = $DaysOffService;
    }
    public function index()
    {
        return $this->DaysOffService->getAllDaysOffs();
    }
    public function store(DaysOffRequest $request)
    {
        // Logic to create a new DaysOff
        return $this->DaysOffService->storeDaysOff($request->all());
    }
    public function update(DaysOffRequest $request, $id)
    {
        // Logic to update an existing DaysOff
        return $this->DaysOffService->updateDaysOff($id, $request->all());
    }
    public function destroy($id)
    {
        // Logic to delete a DaysOff
        return $this->DaysOffService->destroyDaysOff($id);
    }
}
