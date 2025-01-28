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

    public function findByTimeRange(Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->logRepository->findByTimeRange($startDate, $endDate);
    }

    public function findByCompanyTimeRange(Company $company, Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->logRepository->findByCompanyTimeRange($company, $startDate, $endDate);
    }

    public function sum(Collection $logs): int
    {
        return $logs->sum(function($log) {
           return $log->rate * $log->hours;
        });
    }

    public function owed(Collection $logs): int
    {
        return $logs->sum(function($log) {
            return 10 * $log->hours;
        });
    }
    public function store(LogDTO $logDTO): void
    {
        $this->logRepository->store($logDTO);
    }

    public function update(Log $log, LogDTO $logDTO): void
    {
        $this->logRepository->update($log, $logDTO);
    }

    public function delete(Log $logDTO): void
    {
        $this->logRepository->delete($logDTO);
    }
}
