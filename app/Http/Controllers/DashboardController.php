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

        $currentMonthlogs = $this->logService->findByTimeRange(Carbon::now()->copy()->startOfMonth(), Carbon::now()->copy()->endOfMonth());
        $previousMonthLogs = $this->logService->findByTimeRange(Carbon::now()->copy()->subMonth()->startOfMonth(), Carbon::now()->copy()->subMonth()->endOfMonth());

        $accumulatedRevenue = $this->logService->sum($currentMonthlogs);
        $accumulatedRevenuePreviousMonth = $this->logService->sum($previousMonthLogs);
        $accumulatedRevenueGrowth = ($accumulatedRevenuePreviousMonth !== 0)
            ? ($accumulatedRevenue - $accumulatedRevenuePreviousMonth) / $accumulatedRevenuePreviousMonth * 100
            : 100;

        $hoursWorked = $this->logService->hours($currentMonthlogs);
        $hoursWorkedPreviousMonth = $this->logService->hours($previousMonthLogs);
        $hoursWorkedGrowth = ($hoursWorkedPreviousMonth !== 0)
            ? ($hoursWorked - $hoursWorkedPreviousMonth) / $hoursWorkedPreviousMonth * 100
            : 100;

        $daysLeft = round(Carbon::now()->diffInDays(Carbon::now()->endOfMonth()));

        $averageFreelanceWage = $accumulatedRevenue / $hoursWorked;
        $averageFreelanceWagePreviousMonth = ($accumulatedRevenuePreviousMonth !== 0 || $hoursWorkedPreviousMonth !== 0)
            ? $accumulatedRevenuePreviousMonth / $hoursWorkedPreviousMonth
            : 0;
        $averageFreelanceWageGrowth = ($averageFreelanceWagePreviousMonth !== 0)
            ? ($averageFreelanceWage - $averageFreelanceWagePreviousMonth) / $averageFreelanceWagePreviousMonth * 100
            : 100;

        return Inertia::render('Admin/Dashboard/Dashboard', [
            'logs' => LogResource::collection($currentMonthlogs),
            'monthlyRevenue' => $monthlyRevenue,
            'accumulatedRevenue' => $accumulatedRevenue,
            'accumulatedRevenueGrowth' => $accumulatedRevenueGrowth,
            'hoursWorked' => $hoursWorked,
            'hoursWorkedGrowth' => $hoursWorkedGrowth,
            'daysLeft' => $daysLeft,
            'averageFreelanceWage' => $averageFreelanceWage,
            'averageFreelanceWageGrowth' => $averageFreelanceWageGrowth,
        ]);
    }
}
