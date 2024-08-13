<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\CreateCompanyRequest;
use App\Http\Requests\Companies\FindKVKRequest;
use App\Models\Company;
use App\Models\User;
use App\Services\KVKService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegisterController extends Controller
{
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

    public function find(): InertiaResponse
    {
        return Inertia::render('Auth/Find');
    }

    public function found(FindKVKRequest $request): RedirectResponse
    {
        $kvkService = new KVKService();

        $companyDTO = $kvkService->getCompanyDetails($request->kvk_to_find);

        return redirect()->route('register.set-company')->with(['company' => $companyDTO?->company()]);
    }

    public function getCompany(): InertiaResponse
    {
        if (Session::has('company')) {
            return Inertia::render('Auth/Company', [
                'company' => Session::get('company')
            ]);
        }

        return Inertia::render('Auth/Company');
    }

    public function setCompany(CreateCompanyRequest $request): RedirectResponse
    {
        $company = Company::where('kvk', $request->kvk)->exists() === false
            ? Company::create([
                'name' => $request->name,
                'kvk' => $request->kvk,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ])
            : Company::where('kvk', $request->kvk)->first();

        return redirect()->route('register.create')->with(['company' => $company]);
    }
}
