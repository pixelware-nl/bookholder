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
        return Auth::user()->logs()->get();
    }

    public function findByPayed(bool $payed): Collection
    {
        return Auth::user()->logs()->where('payed', $payed)->get();
    }

    public function findByTimeRange(Carbon $startDate, Carbon $endDate, ?bool $payed = null): Collection
    {
        $builder = Auth::user()->logs()
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate);

        if ($payed !== null) {
            $builder->where('payed', $payed);
        }

        return $builder->get();
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
            'minutes' => $logDTO->getMinutes(),
            'name' => $logDTO->getName(),
            'description' => $logDTO->getDescription(),
            'created_at' => $logDTO->getCreatedAt()
        ]);
    }

    public function update(Log $log, LogDTO $logDTO): Log
    {
        $log->update([
            'company_id' => $logDTO->getCompanyId(),
            'rate' => $logDTO->getRate(),
            'hours' => $logDTO->getHours(),
            'minutes' => $logDTO->getMinutes(),
            'name' => $logDTO->getName(),
            'description' => $logDTO->getDescription(),
            'created_at' => $logDTO->getCreatedAt()
        ]);

        return $log;
    }

    public function payed(Log $log, bool $payed): Log
    {
        $log->update([
            'payed' => $payed
        ]);

        return $log;
    }

    public function delete(Log $log): void
    {
        $log->delete();
    }
}
