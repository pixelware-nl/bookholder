<?php

namespace App\Enums\Tests;

enum KVKNumber: string
{
    // @TODO add function to filter between successful and error KVK numbers
    case SUCCESSFUL_EENMANSZAAK_RESPONSE = '69599084';
    case SUCCESSFUL_NV_RESPONSE = '68727720';
    case SUCCESSFUL_BV_RESPONSE = '68750110';

    case SUCCESSFUL_VOF_RESPONSE = '69599076';
    case SUCCESSFUL_COOPERATIE_RESPONSE = '55344526';
    case SUCCESSFUL_OWM_RESPONSE = '90002490';
    case SUCCESSFUL_MAATSCHAP_RESPONSE = '90001745';
    case SUCCESSFUL_CV_RESPONSE = '90003942';
    case ERROR_OPR_RESPONSE = '55505201';
    case ERROR_VVE_RESPONSE = '90000749';
    case ERROR_STICHTING_RESPONSE = '90000102';
    case ERROR_KERKGENOOTSCHAP_RESPONSE = '90002520';
    case ERROR_RESPONSE = '90004973';
    case ERROR_RESPONSE_ALTERNATIVE = '90002903';

    public static function toArray(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public static function successCases(): array
    {
        return array_filter(self::cases(), function ($case) {
            return str_contains($case->name, 'SUCCESSFUL');
        });
    }

    public static function errorCases(): array
    {
        return array_filter(self::cases(), function ($case) {
            return str_contains($case->name, 'ERROR');
        });
    }
}
