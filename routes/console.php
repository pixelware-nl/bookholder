<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('test', function() {
    // Test case here
});

Artisan::command('testtest', function () {


    $search = "Wijnhaven 20C";
    $this->info("Searching for: \"$search\"");

    $matches = [];
    if (preg_match($pattern, $search, $matches)) {
        $this->info("Finding results");
        $result = [
            'street'        => trim($matches['street'] ?? ''),
            'housenumber'   => trim($matches['housenumber'] ?? ''),
            'addition'      => trim($matches['addition'] ?? ''),
            'hasHouseNumber' => !empty($matches['housenumber']),
            'hasAddition'   => !empty($matches['addition'])
        ];

        dd($result);
    }
});

