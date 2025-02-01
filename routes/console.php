<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('test', function() {
    \App\Models\Log::where('payed', 0)->get()->each(function($log) {
        $this->info('Updating log: ' . $log->id);
        $success = $log->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->info('Success: ' . $success);
    });
});
