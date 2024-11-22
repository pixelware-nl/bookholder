<?php

namespace App\Http\Controllers;

use App\DTO\CompanyDTO;
use App\DTO\LogDTO;
use App\Exceptions\InvalidArrayParamsException;
use App\Exceptions\InvalidRequestToDTOException;
use App\Helpers\KVKHelper;
use App\Http\Requests\Companies\CreateCompanyRequest;
use App\Http\Requests\Companies\FindKVKRequest;
use App\Http\Requests\Logs\CreateLogRequest;
use App\Http\Resources\LogResource;
use App\Models\Company;
use App\Models\Log;
use App\Models\UserCompany;
use App\Services\CompanyService;
use App\Services\LogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class LogController extends Controller
{
    public function __construct(
        private readonly LogService $logService
    ) {}

    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Log/Index', [
            'logs' => LogResource::collection(
                Auth::user()->logs()->get()
            )
        ]);
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Log/Create', [
            'companies' => Auth::user()->companies()->get()
        ]);
    }

    /**
     * @throws InvalidRequestToDTOException
     */
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
