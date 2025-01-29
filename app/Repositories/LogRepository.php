<?php

namespace App\Repositories;

use App\DTO\LogDTO;
use App\Models\Company;
use App\Models\Log;
use App\Repositories\Interfaces\LogRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class LogRepository implements LogRepositoryInterface
{

    public function all(): Collection
    {
        return Log::all();
    }

    public function findByTimeRange(Carbon $startDate, Carbon $endDate): Collection
    {
        return Auth::user()->logs()
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();
    }

    public function findByCompanyTimeRange(Company $company, Carbon $startDate, Carbon $endDate): Collection
    {
        return Auth::user()->logs()
            ->where('company_id', $company->id)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();
    }

    public function store(LogDTO $logDTO): Log
    {
        return Log::create([
            'user_id' => Auth::id(),
            'company_id' => $logDTO->getCompanyId(),
            'rate' => $logDTO->getRate(),
            'hours' => $logDTO->getHours(),
            'name' => $logDTO->getName(),
            'description' => $logDTO->getDescription()
        ]);
    }

    public function update(Log $log, LogDTO $logDTO): Log
    {
        $log->update([
            'company_id' => $logDTO->getCompanyId(),
            'rate' => $logDTO->getRate(),
            'hours' => $logDTO->getHours(),
            'name' => $logDTO->getName(),
            'description' => $logDTO->getDescription()
        ]);

        return $log;
    }

    public function payed(Log $log): Log
    {
        $log->update([
            'payed' => true
        ]);

        return $log;
    }

    public function delete(Log $log): void
    {
        $log->delete();
    }
}
