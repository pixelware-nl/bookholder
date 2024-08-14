<?php

namespace App\Helpers;

use App\Exceptions\InvalidRequestToDTOException;
use Illuminate\Http\Request;

class DTOHelper
{
    public static function missingRequiredRequestParams(array $required, Request $request): bool
    {
        return (count(array_diff_key(array_flip($required), $request->all())) > 0);
    }
}
