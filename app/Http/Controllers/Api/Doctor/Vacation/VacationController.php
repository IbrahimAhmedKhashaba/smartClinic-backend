<?php

namespace App\Http\Controllers\Api\Doctor\Vacation;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacationRequest;
use App\Interfaces\Doctor\Services\Vacation\VacationServiceInterface;

class VacationController extends Controller
{
    //
    private $VacationService;
    public function __construct(VacationServiceInterface $VacationService)
    {
        $this->VacationService = $VacationService;
    }
    public function index()
    {
        return $this->VacationService->getAllVacations();
    }
    public function store(VacationRequest $request)
    {
        // Logic to create a new Vacation
        return $this->VacationService->storeVacation($request->all());
    }
    public function update(VacationRequest $request, $id)
    {
        // Logic to update an existing Vacation
        return $this->VacationService->updateVacation($id, $request->all());
    }
    public function destroy($id)
    {
        // Logic to delete a Vacation
        return $this->VacationService->destroyVacation($id);
    }
}
