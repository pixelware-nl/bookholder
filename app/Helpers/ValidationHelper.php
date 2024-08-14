<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class ValidationHelper
{
    public static function isMissingRequiredRequestParams(array $required, Request $request): bool
    {
        return (count(array_diff_key(array_flip($required), $request->all())) > 0);
    }

    public static function isMissingRequiredArrayParams(array $required, array $company): bool
    {
        return (count(array_diff_key(array_flip($required), $company)) > 0);
    }
}
