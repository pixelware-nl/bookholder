<?php

namespace App\Http\Controllers;

use App\Http\Resources\FreelanceLogEntryResource;
use App\Services\FreelanceLogService;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __construct(
        private readonly FreelanceLogService $freelanceLogService = new FreelanceLogService()
    ) {}

    public function index(): InertiaResponse
    {
        $freelanceLogs = $this->freelanceLogService->getFreelanceLogs(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $freelanceLogTotal = $this->freelanceLogService->getFreelanceLogsTotal($freelanceLogs);

        return Inertia::render('Admin/Dashboard/Dashboard', [
            'freelanceLogs' => FreelanceLogEntryResource::collection($freelanceLogs),
            'freelanceLogTotal' => $freelanceLogTotal,
            'daysUntilNewMonth' => round(Carbon::now()->diffInDays(Carbon::now()->endOfMonth()))
        ]);
    }
}
