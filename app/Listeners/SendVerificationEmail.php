<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationEmail
{
    public function __construct()
    {
        //
    }

    public function handle(UserCreated $event): void
    {
        // Send an email to the user..
    }
}
