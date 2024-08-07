<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Models\Company;
use Inertia\Inertia;
use \Inertia\Response as InertiaResponse;
use \Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Company/Index', [
            'companies' => Company::all()
        ]);
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Company/Create');
    }

    public function store(CreateCompanyRequest $request): RedirectResponse
    {
        Company::create([
            'name' => $request->name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        return redirect()->route('companies.index');
    }
}
