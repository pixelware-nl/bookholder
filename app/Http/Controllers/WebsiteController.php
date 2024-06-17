<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class WebsiteController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render(
            'App',
            [
                'company' => config('app.company.name'),
                'slogan' => config('app.company.slogan')
            ]
        );
    }
}
