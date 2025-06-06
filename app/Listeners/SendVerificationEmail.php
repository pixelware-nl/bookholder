<?php

namespace App\Listeners;

use App\Events\UserCreated;

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
