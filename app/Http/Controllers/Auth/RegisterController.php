<?php

namespace App\Http\Controllers\Auth;

use App\DTO\CompanyDTO;
use App\Exceptions\InvalidArrayParamsException;
use App\Exceptions\InvalidRequestToDTOException;
use App\Helpers\KVKHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\CreateCompanyRequest;
use App\Http\Requests\Companies\FindKVKRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegisterController extends Controller
{
    public function find(): InertiaResponse
    {
        return Inertia::render('Auth/Find');
    }

    public function found(FindKVKRequest $request): RedirectResponse
    {
        return KVKHelper::redirectOnSuccess($request->kvk_to_find);
    }

    public function getCompany(?string $kvk = null): InertiaResponse
    {
        if (Session::has('company')) {
            return Inertia::render('Auth/Company', [
                'company' => Session::get('company'),
                'kvk' => $kvk
            ]);
        }

        return Inertia::render('Auth/Company', ['kvk' => $kvk]);
    }

    /**
     * @throws InvalidRequestToDTOException
     * @throws InvalidArrayParamsException
     */
    public function setCompany(CreateCompanyRequest $request): RedirectResponse
    {
        $companyDTO = CompanyDTO::fromRequest($request);

        $company = Company::createOrGet($companyDTO->toArray());

        return redirect()->route('register.create')->with(['company' => $company]);
    }

    public function create(): InertiaResponse|RedirectResponse
    {
        if (Auth::check()) {
            // @TODO: Redirect to a dashboard
            return redirect()->route('invoices.index');
        }

        if (Session::has('company')) {
            return Inertia::render('Auth/Register', [
                'company' => Session::get('company')
            ]);
        }

        return Inertia::render('Auth/Register');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $fullname = strtolower(
            sprintf('%s %s', ucfirst($request->firstname), ucfirst($request->lastname))
        );

        $email = strtolower($request->email);

        User::create([
            'full_name' => $fullname,
            'email' => $email,
            'password' => \Hash::make($request->password),
            'company_id' => $request->company_id
        ]);

        return redirect()->route('login');
    }
}
