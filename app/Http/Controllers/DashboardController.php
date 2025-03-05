<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogResource;
use App\Services\DashboardService;
use App\Services\LogService;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardService $dashboardService
    ) {}

    public function index(): InertiaResponse
    {


        return Inertia::render('Admin/Dashboard/Dashboard', [
            'logs' => LogResource::collection($this->dashboardService->getCurrentMonthLogs()),
            'monthlyRevenue' => $this->dashboardService->getMonthlyRevenue(),
            'accumulatedRevenue' => $this->dashboardService->getAccumulatedRevenueData()->toArray(),
            'hoursWorked' => $this->dashboardService->getHoursWorkedData()->toArray(),
            'freelanceWage' => $this->dashboardService->getFreelanceWageData()->toArray(),
            'daysLeft' => $this->dashboardService->getDaysLeft(),
        ]);
    }
}
