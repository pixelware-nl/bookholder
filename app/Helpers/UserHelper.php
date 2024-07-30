<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function isAuthenticated(): bool
    {
        return !is_null(Auth::user());
    }
}
