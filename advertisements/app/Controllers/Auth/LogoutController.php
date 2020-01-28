<?php

namespace App\Controllers\Auth;

use App\AuthManager;
use App\Middlewares\Authorized;

class LogoutController
{
    public function __construct()
    {
        (new Authorized())->handle();
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}