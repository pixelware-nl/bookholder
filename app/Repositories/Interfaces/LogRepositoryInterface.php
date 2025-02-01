<?php

namespace App\Repositories\Interfaces;

use App\DTO\LogDTO;
use App\Models\Company;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface LogRepositoryInterface
{
    public function all(): Collection;

    public function findByTimeRange(Carbon $startDate, Carbon $endDate, bool $payed): Collection;

    public function findByCompanyTimeRange(Company $company, Carbon $startDate, Carbon $endDate): Collection;

    public function store(LogDTO $logDTO): Log;

    public function update(Log $log, LogDTO $logDTO): Log;

    public function delete(Log $log): void;
}
