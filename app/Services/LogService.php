<?php

namespace App\Services;

use App\DTO\LogDTO;
use App\Models\Company;
use App\Models\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class LogService
{
    /*
     * Eventually we want to have users to which the following is tied to
     * public function getUserFreelanceLogs(User $user, Carbon $startDate = Carbon::now(), int $lengthInMonths = 1);
     */
    public function getLogs(Carbon $startDate, Carbon $endDate): Collection
    {
        return Auth::user()->logs()
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();
    }

    public function getTotalLogs(Collection $logs): int
    {
        return $logs->sum(function($log) {
           return $log->rate * $log->hours;
        });
    }

    public function create(LogDTO $logDTO): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'company_id' => $logDTO->getCompanyId(),
            'rate' => $logDTO->getRate(),
            'hours' => $logDTO->getHours(),
            'name' => $logDTO->getName(),
            'description' => $logDTO->getDescription()
        ]);
    }
}
