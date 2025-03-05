<?php

namespace App\Services;

use App\DTO\DashboardCardDTO;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DashboardService
{
    private Collection $currentMonthLogs;
    private Collection $previousMonthLogs;

    public function __construct(
        private readonly LogService $logService
    ) {
        $this->currentMonthLogs = $this->logService->findByTimeRange(Carbon::now()->copy()->startOfMonth(), Carbon::now()->copy()->endOfMonth());
        $this->previousMonthLogs = $this->logService->findByTimeRange(Carbon::now()->copy()->subMonth()->startOfMonth(), Carbon::now()->copy()->subMonth()->endOfMonth());
    }

    public function getCurrentMonthLogs(): Collection
    {
        return $this->currentMonthLogs;
    }

    public function getPreviousMonthLogs(): Collection
    {
        return $this->previousMonthLogs;
    }

    public function getDaysLeft(): int
    {
        return round(Carbon::now()->diffInDays(Carbon::now()->endOfMonth()));
    }

    public function getMonthlyRevenue(): Collection
    {
        return collect(range(1, 12))->map(function($month) {
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
    }

    public function getAccumulatedRevenueData(): DashboardCardDTO
    {
        return new DashboardCardDTO(
            $this->getAccumulatedRevenue(),
            $this->getAccumulatedRevenuePreviousMonth(),
            round($this->getAccumulatedRevenueGrowth())
        );
    }

    public function getHoursWorkedData(): DashboardCardDTO
    {
        return new DashboardCardDTO(
            $this->getHoursWorked(),
            $this->getHoursWorkedPreviousMonth(),
            round($this->getHoursWorkedGrowth())
        );
    }

    public function getFreelanceWageData(): DashboardCardDTO
    {
        return new DashboardCardDTO(
            $this->getFreelanceWage(),
            $this->getFreelanceWagePreviousMonth(),
            round($this->getFreelanceWageGrowth())
        );
    }

    private function getAccumulatedRevenue(): float
    {
        return $this->logService->sum($this->currentMonthLogs);
    }

    private function getAccumulatedRevenuePreviousMonth(): float
    {
        return $this->logService->sum($this->previousMonthLogs);
    }

    private function getAccumulatedRevenueGrowth(): float
    {
        return $this->getGrowthPercentage($this->getAccumulatedRevenue(), $this->getAccumulatedRevenuePreviousMonth());
    }

    private function getHoursWorked(): float
    {
        return $this->logService->hours($this->currentMonthLogs);
    }

    private function getHoursWorkedPreviousMonth(): float
    {
        return $this->logService->hours($this->previousMonthLogs);
    }

    private function getHoursWorkedGrowth(): float
    {
        return $this->getGrowthPercentage($this->getHoursWorked(), $this->getHoursWorkedPreviousMonth());
    }

    private function getFreelanceWage(): float
    {
        if ($this->getAccumulatedRevenue() == 0 || $this->getHoursWorked() == 0) {
            return 0;
        }

        return $this->getAccumulatedRevenue() / $this->getHoursWorked();
    }

    private function getFreelanceWagePreviousMonth(): float
    {
        if ($this->getAccumulatedRevenuePreviousMonth() == 0 || $this->getHoursWorked () == 0) {
            return 0;
        }

        return $this->getAccumulatedRevenuePreviousMonth() / $this->getHoursWorkedPreviousMonth();
    }

    private function getFreelanceWageGrowth(): float
    {
        return $this->getGrowthPercentage($this->getFreelanceWage(), $this->getFreelanceWagePreviousMonth());
    }

    private function getGrowthPercentage(float $currentMonth, float $previousMonth): float|int
    {
        if ($currentMonth == 0 && $previousMonth == 0) {
            return 0;
        }

        if ($currentMonth != 0 && $previousMonth == 0) {
            return 100;
        }

        $percentage = ($currentMonth - $previousMonth) / $previousMonth * 100;

        return ($percentage < 0)
            ? 0
            : $percentage;
    }
}
