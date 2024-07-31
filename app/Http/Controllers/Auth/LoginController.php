<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class LoginController extends Controller
{
    public function create(): InertiaResponse|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->back();
        }

        return Inertia::render('Auth/Login');
    }

    public function authenticate(AuthenticateLoginRequest $request): RedirectResponse
    {
        $credentials = $request->toArray();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // @TODO: Redirect to a dashboard
            return redirect()->intended(route('invoices.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
