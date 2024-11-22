<?php

namespace App\Http\Controllers;

use App\DTO\CompanyDTO;
use App\Exceptions\InvalidArrayParamsException;
use App\Exceptions\InvalidRequestToDTOException;
use App\Helpers\KVKHelper;
use App\Http\Requests\Companies\CreateCompanyRequest;
use App\Http\Requests\Companies\FindKVKRequest;
use App\Http\Resources\LogResource;
use App\Models\Company;
use App\Models\UserCompany;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class LogController extends Controller
{
    public function __construct(
        private readonly CompanyService $companyService
    ) {}

    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Log/Index', [
            'logs' => LogResource::collection(
                Auth::user()->logs()->get()
            )
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

    /**
     * @throws InvalidRequestToDTOException
     * @throws InvalidArrayParamsException
     */
    public function store(CreateCompanyRequest $request): RedirectResponse
    {
        $this->companyService->createForAuth(CompanyDTO::fromRequest($request));

        return redirect()->route('companies.index');
    }

    public function destroy(Company $company): SymfonyResponse
    {
        UserCompany::authFind($company->id)->delete();

        return redirect()->route('companies.index');
    }

    public function find(): InertiaResponse
    {
        return Inertia::render('Admin/Company/Find');
    }

    public function found(FindKVKRequest $request): RedirectResponse
    {
        $company = Company::fromKvk($request->kvk_to_find);

        if ($company->exists()) {
            $this->companyService->attachToAuth($company->first());

            return redirect()->route('companies.index');
        }

        return KVKHelper::redirectOnSuccess($request->kvk_to_find, 'company.create');
    }
}
