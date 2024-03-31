<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function MailOverview(): Response
    {
        return Inertia::render('Admin/MailPage');
    }
}
