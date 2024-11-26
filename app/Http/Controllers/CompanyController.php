<?php

namespace App\Http\Controllers;

use App\DTO\CompanyDTO;
use App\Http\Requests\Companies\CreateCompanyRequest;
use App\Http\Requests\Companies\FindKVKRequest;
use App\Models\Company;
use App\Services\CompanyService;
use App\Services\KVKService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class CompanyController extends Controller
{
    public function __construct(
        private readonly CompanyService $companyService,
        private readonly KVKService $kvkService,
        private readonly UserService $userService
    ) {}

    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Company/Index', [
            'userCompany' => $this->userService->company(),
            'companies' => $this->userService->companies(),
        ]);
    }

    public function create(?string $kvk = null): InertiaResponse
    {
        if (Session::has('company')) {
            return Inertia::render('Admin/Company/Create', [
                'company' => Session::get('company'),
                'kvk' => $kvk,
            ]);
        }

        return Inertia::render('Admin/Company/Create', ['kvk' => $kvk]);
    }

    public function store(CreateCompanyRequest $request): RedirectResponse
    {
        $this->companyService->store(CompanyDTO::fromRequest($request));

        return redirect()->route('companies.index');
    }

    public function destroy(Company $company): SymfonyResponse
    {
        $this->companyService->detach($company);

        return redirect()->route('companies.index');
    }

    public function find(): InertiaResponse
    {
        return Inertia::render('Admin/Company/Find');
    }

    public function found(FindKVKRequest $request): RedirectResponse
    {
        $company = $this->companyService->findByKvk($request->kvk_to_find);

        if ($company !== null) {
            $this->companyService->attach($company);

            return redirect()->route('companies.index');
        }

        return $this->kvkService->redirectOnSuccess($request->kvk_to_find, 'company.create');
    }
}
