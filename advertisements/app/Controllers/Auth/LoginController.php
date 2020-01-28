<?php

namespace App\Controllers\Auth;


use App\Middlewares\RedirectIfAuthenticated;
use App\Models\User;

class LoginController
{
    public function __construct()
    {
        (new RedirectIfAuthenticated())->handle();
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function showSignupForm()
    {
        return view('auth/signup');
    }

    public function login()
    {
        $user = database()->get('users', '*', [
            'email' => $_POST['email'],
            'password' => md5($_POST['password'])
        ]);

        if (empty($user)) {
            flashMessage()->set('Invalid username or password.');
            return redirect('/auth/login');
        }
        return $this->adminLogin($user);
    }

    public function adminLogin($user)
    {
        $hashedPass = md5($_POST['password']);
        $admin = database()->select("users", ["email", "password"], ["email" => "admin@ads.com"]);

        if (($admin[0]['email'] === $_POST['email']) && ($admin[0]['password'] === $hashedPass)) {
            auth()->loginById($user['id']);
            return redirect('/admin');
        } else {
            auth()->loginById($user['id']);
            return redirect('/');
        }
    }
}