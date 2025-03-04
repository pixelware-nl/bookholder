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

        $currentMonthLogs = $this->logService->findByTimeRange(Carbon::now()->copy()->startOfMonth(), Carbon::now()->copy()->endOfMonth());
        $previousMonthLogs = $this->logService->findByTimeRange(Carbon::now()->copy()->subMonth()->startOfMonth(), Carbon::now()->copy()->subMonth()->endOfMonth());

        $accumulatedRevenue = $this->logService->sum($currentMonthLogs);
        $accumulatedRevenuePreviousMonth = $this->logService->sum($previousMonthLogs);
        if ($accumulatedRevenuePreviousMonth !== 0 && $accumulatedRevenue !== 0) {
            $accumulatedRevenueGrowth = ($accumulatedRevenue - $accumulatedRevenuePreviousMonth) / $accumulatedRevenuePreviousMonth * 100;
        } else if ($accumulatedRevenuePreviousMonth === 0 && $accumulatedRevenue !== 0) {
            $accumulatedRevenueGrowth = 100;
        } else {
            $accumulatedRevenueGrowth = 0;
        }

        $hoursWorked = $this->logService->hours($currentMonthlogs);
        $hoursWorkedPreviousMonth = $this->logService->hours($previousMonthLogs);
        if ($hoursWorkedPreviousMonth !== 0 && $hoursWorked !== 0) {
            $hoursWorkedGrowth = ($hoursWorked - $hoursWorkedPreviousMonth) / $hoursWorkedPreviousMonth * 100;
        } else if ($hoursWorkedPreviousMonth === 0 && $hoursWorked !== 0) {
            $hoursWorkedGrowth = 100;
        } else {
            $hoursWorkedGrowth = 0;
        }

        $daysLeft = round(Carbon::now()->diffInDays(Carbon::now()->endOfMonth()));

        // AVERAGE FREELANGE WAGE
        $averageFreelanceWage = ($accumulatedRevenue !== 0 || $hoursWorked !== 0)
            ? $accumulatedRevenue / $hoursWorked
            : 0;
        $averageFreelanceWagePreviousMonth = ($accumulatedRevenuePreviousMonth !== 0 || $hoursWorkedPreviousMonth !== 0)
            ? $accumulatedRevenuePreviousMonth / $hoursWorkedPreviousMonth
            : 0;

        if ($averageFreelanceWagePreviousMonth !== 0 && $averageFreelanceWage !== 0) {
            $averageFreelanceWageGrowth = ($averageFreelanceWage - $averageFreelanceWagePreviousMonth) / $averageFreelanceWagePreviousMonth * 100;
        } else if ($averageFreelanceWagePreviousMonth === 0 && $averageFreelanceWage !== 0) {
            $averageFreelanceWageGrowth = 100;
        } else {
            $averageFreelanceWageGrowth = 0;
        }

        return Inertia::render('Admin/Dashboard/Dashboard', [
            'logs' => LogResource::collection($currentMonthLogs),
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
