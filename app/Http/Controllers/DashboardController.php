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
        $logs = $this->logService->findByTimeRange(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $unpaidLogs = $this->logService->findUnpaidByTimeRange(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $payedLogs = $this->logService->findByPayed(true);

        $sumUnpaidTotal = $this->logService->sum($unpaidLogs);
        $sumPayedTotal = $this->logService->sum($payedLogs);

        return Inertia::render('Admin/Dashboard/Dashboard', [
            'logs' => LogResource::collection($logs),
            'sumPayedTotal' => $sumPayedTotal,
            'sumUnpaidTotal' => $sumUnpaidTotal,
            'daysUntilNewMonth' => round(Carbon::now()->diffInDays(Carbon::now()->endOfMonth()))
        ]);
    }
}
