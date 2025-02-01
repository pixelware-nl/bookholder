<?php

namespace App\Services;

use Carbon\Carbon;

class DateService
{
    public static function format(Carbon $date): string
    {
        return match(app()->getLocale()) {
            'nl' => $date->format('d-m-Y'),
            default => $date->format('m-d-Y'),
        };
    }
}
