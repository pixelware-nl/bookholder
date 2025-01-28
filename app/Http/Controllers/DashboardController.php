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
        $totalLogs = $this->logService->sum($logs);
        $totalOwed = $this->logService->owed($logs);

        return Inertia::render('Admin/Dashboard/Dashboard', [
            'logs' => LogResource::collection($logs),
            'totalLogs' => $totalLogs,
            'totalOwed' => $totalOwed,
            'daysUntilNewMonth' => round(Carbon::now()->diffInDays(Carbon::now()->endOfMonth()))
        ]);
    }
}
