<?php

namespace App\Http\Controllers\Auth;

use App\DTO\CompanyDTO;
use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateCompanyRequest;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Companies\FindKVKRequest;
use App\Services\CompanyService;
use App\Services\KVKService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegisterController extends Controller
{
    public function __construct(
        private readonly KVKService $kvkService,
        private readonly CompanyService $companyService,
        private readonly UserService $userService
    ) {}

    public function find(): InertiaResponse
    {
        return Inertia::render('Auth/Find');
    }

    public function found(FindKVKRequest $request): RedirectResponse
    {
        $companyDTO = $this->companyService->findByKvk($request->kvk_to_find);

        if ($companyDTO !== null) {
            return redirect()->route('register.get-company', ['kvk' => $request->kvk_to_find])->with(['company' => $companyDTO]);
        }

        return $this->kvkService->redirectOnSuccess($request->kvk_to_find, 'register.create');
    }

    public function getCompany(?string $kvk = null): InertiaResponse
    {
        if (Session::has('company')) {
            return Inertia::render('Auth/Company', [
                'company' => Session::get('company'),
                'kvk' => $kvk,
            ]);
        }

        return Inertia::render('Auth/Company', ['kvk' => $kvk]);
    }

    public function setCompany(CreateCompanyRequest $request): RedirectResponse
    {
        $company = $this->companyService->storeOrGet(CompanyDTO::fromRequest($request));

        return redirect()->route('register.create')->with(['company' => $company]);
    }

    public function create(): InertiaResponse|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        if (Session::has('company')) {
            return Inertia::render('Auth/Register', [
                'company' => Session::get('company'),
            ]);
        }

        return Inertia::render('Auth/Register');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $this->userService->store(UserDTO::fromRequest($request));

        return redirect()->route('login');
    }
}
