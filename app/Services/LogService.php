<?php

namespace App\Services;

use App\DTO\LogDTO;
use App\Models\Company;
use App\Models\Log;
use App\Repositories\LogRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

readonly class LogService
{
    public function __construct(
        private LogRepository $logRepository
    ) {}

    public function all(): Collection
    {
        return $this->logRepository->all();
    }

    public function findByPayed(bool $payed): Collection
    {
        return $this->logRepository->findByPayed($payed);
    }

    public function findByTimeRange(Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->logRepository->findByTimeRange($startDate, $endDate);
    }

    public function findUnpaidByTimeRange(Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->logRepository->findByTimeRange($startDate, $endDate, false);
    }

    public function findPayedByTimeRange(Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->logRepository->findByTimeRange($startDate, $endDate, true);
    }

    public function findByCompanyTimeRange(Company $company, Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->logRepository->findByCompanyTimeRange($company, $startDate, $endDate);
    }

    public function sum(Collection $logs): int
    {
        return $logs->sum(function ($log) {
            return $log->rate * ($log->hours + ($log->minutes / 60));
        });
    }

    public function hours(Collection $logs): int
    {
        return $logs->sum(function ($log) {
            return $log->hours;
        });
    }

    public function store(LogDTO $logDTO): Log
    {
        return $this->logRepository->store($logDTO);
    }

    public function update(Log $log, LogDTO $logDTO): Log
    {
        return $this->logRepository->update($log, $logDTO);
    }

    public function delete(Log $logDTO): void
    {
        $this->logRepository->delete($logDTO);
    }

    public function payed(Log $log, bool $payed): Log
    {
        return $this->logRepository->payed($log, $payed);
    }
}
