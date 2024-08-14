<?php

namespace App\Helpers;

use App\Services\KVKService;
use Illuminate\Http\RedirectResponse;

class KVKHelper
{
    public static function redirectOnSuccess(string $kvk, string $route): RedirectResponse
    {
        $kvkService = new KVKService();

        $companyDTO = $kvkService->getCompanyDetails($kvk);

        if ($companyDTO == null) {
            return redirect()->back()->withErrors([
                'kvk_to_find' => 'KVK not found.'
            ]);
        }

        return redirect()->route($route)->with(['company' => $companyDTO->company()]);
    }
}
