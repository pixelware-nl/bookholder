<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\CreateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

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

    /**
     * @throws ConnectionException
     */
    public function findKvk(Request $request)
    {
        if (!$request->has('kvk')) {
            dd("No KVK number retrieved.");
        }

        $response = Http::withHeaders([
            'apikey' => 'l7xx1f2691f2520d487b902f4e0b57a0b197'
        ])->get(sprintf('https://api.kvk.nl/test/api/v1/basisprofielen/%s/hoofdvestiging', $request->input('kvk')));

        $response = json_decode($response->body());
        $address = $response->adressen[0];

        $fullStreetAddress = sprintf('%s %s%s', $address->straatnaam, $address->huisnummer, $address->huisletter);

        Company::create([
            'name' => $response->eersteHandelsnaam,
            'kvk' => $response->kvkNummer,
            'street_address' => $fullStreetAddress,
            'city' => $address->plaats,
            'province' => 'Unknown',
            'postal_code' => $address->postcode,
            'country' => $address->land,
        ]);

        dd([
            'Company created successfully.',
            $response
        ]);
    }
}
