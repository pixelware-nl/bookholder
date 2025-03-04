<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogResource;
use App\Services\LogService;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __construct(
        private readonly LogService $logService
    ) {}

    public function index(): InertiaResponse
    {
        $monthlyRevenue = collect(range(1, 12))->map(function($month) {
            $date = Carbon::now()->month($month);
            $revenue = $this->logService->sum(
                $this->logService->findByTimeRange($date->copy()->startOfMonth(), $date->copy()->endOfMonth())
            );

            return [
                'name' => $date->format('F'),
                'revenue' => $revenue,
                'profit' => $revenue * 0.6
            ];
        });

        $logs = $this->logService->findByTimeRange(Carbon::now()->startOfYear(), Carbon::now()->endOfMonth());

        $accumulatedRevenue = $this->logService->sum($logs);
        $hoursWorked = $this->logService->hours($logs);
        $daysLeft = round(Carbon::now()->diffInDays(Carbon::now()->endOfMonth()));
        $averageFreelanceWage = $accumulatedRevenue / $hoursWorked;

        return Inertia::render('Admin/Dashboard/Dashboard', [
            'logs' => LogResource::collection($logs),
            'monthlyRevenue' => $monthlyRevenue,
            'accumulatedRevenue' => $accumulatedRevenue,
            'hoursWorked' => $hoursWorked,
            'daysLeft' => $daysLeft,
            'averageFreelanceWage' => $averageFreelanceWage,
        ]);
    }
}
