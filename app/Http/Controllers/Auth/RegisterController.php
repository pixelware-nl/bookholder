<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegisterController extends Controller
{
    public function create(): InertiaResponse|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->back();
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
            'company_id' => 1, // @TODO: user needs to select his company as wel
        ]);

        return redirect()->route('login');
    }
}
