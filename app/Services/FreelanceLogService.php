<?php

namespace App\Services;

use App\Models\Company;
use App\Models\FreelanceLogEntry;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class FreelanceLogService
{
    /*
     * Eventually we want to have users to which the following is tied to
     * public function getUserFreelanceLogs(User $user, Carbon $startDate = Carbon::now(), int $lengthInMonths = 1);
     */

    public function getFreelanceLogs(Company $company, Carbon $startDate = null, int $months = 1): Collection
    {
        $products = Product::where('company_id', $company->id)->pluck('id');

        if (is_null($startDate)) {
            $startDate = Carbon::now()->startOfDay();
        }

        $endDate = Carbon::create($startDate)->addMonths($months);

        return FreelanceLogEntry::where('created_at', '>=', $startDate->toDateString())
            ->where('created_at', '<=', $endDate->toDateString())
            ->whereIn('product_id', $products)
            ->get();
    }

    public function getFreelanceLogsTotal(Collection $freelanceLogs): int
    {
        return $freelanceLogs->sum(function($log) {
           return $log->rate * $log->hours;
        });
    }
}
