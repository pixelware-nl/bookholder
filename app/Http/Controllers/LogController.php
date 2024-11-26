<?php

namespace App\Http\Controllers;

use App\DTO\LogDTO;
use App\Http\Requests\Logs\CreateLogRequest;
use App\Http\Resources\LogResource;
use App\Models\Log;
use App\Services\LogService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class LogController extends Controller
{
    public function __construct(
        private readonly LogService $logService,
        private readonly UserService $userService
    ) {}

    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Log/Index', [
            'logs' => LogResource::collection(
                $this->userService->logs()
            )
        ]);
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Log/Create', [
            'companies' => $this->userService->companies()
        ]);
    }

    public function store(CreateLogRequest $request): RedirectResponse
    {
        $this->logService->store(LogDTO::fromRequest($request));

        return redirect()->route('logs.index');
    }

    public function destroy(Log $log): SymfonyResponse
    {
        $this->logService->delete($log);

        return redirect()->route('logs.index');
    }
}
