<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('change:password {email} {password}', function($email, $password) {
    $user = \App\Models\User::where('email', $email)->first();
    if (!$user) {
        $this->error("User with email {$email} not found.");
        return;
    }
    $user->password = \Illuminate\Support\Facades\Hash::make($password);
    $user->save();
    $this->info("Password for user {$email} has been changed.");
});
