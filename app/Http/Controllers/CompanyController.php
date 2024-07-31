<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Inertia\Inertia;
use \Inertia\Response as InertiaResponse;

class CompanyController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Company/Index', [
            'companies' => Company::all()
        ]);
    }
}
