<?php


namespace App\Controllers;

use App\Controllers\Auth\LoginController;
use Carbon\Carbon;
use Core\Database;
use Core\Managers\FormValidatorManager\FormValidator;

class SignupController
{

    public function signup()
    {
        $validator = new FormValidator();

        formValidate()->validate($_POST, [
            'name' => ['required', 'min:5', 'max:30'],
            'email' => ['required', 'min:5', 'max:30'],
            'password' => ['required', 'min:5', 'max:30']
        ]);

        if (formValidate()->failed()) {
            input()->save($_POST);
            redirect('/auth/signup');
        }


        if ($_POST['password'] != $_POST['confirmPass']) {
            flashMessage()->set('Passwords does not match!');
            redirect('/auth/signup');
        } else {
            $this->checkEmail();
        }
    }

    function checkEmail()
    {
        $existingEmails = database()->select('users', 'email');

        if (in_array($_POST['email'], $existingEmails)) {
            flashMessage()->set('User with such email already exists!');
            redirect('/auth/signup');
        } else {
            $this->addNewUser();
        }
    }

    public function addNewUser()
    {
        database()->insert(
            'users', [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'created_at' => Carbon::now()->format(DATE_ATOM),
            ]
        );
        (new Auth\LoginController)->login();
    }
}