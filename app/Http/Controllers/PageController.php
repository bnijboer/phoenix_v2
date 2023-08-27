<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function login(): Response
    {
        return Inertia::render('security/login-page');
    }

    public function register(): Response
    {
        return Inertia::render('security/register-page');
    }
}
