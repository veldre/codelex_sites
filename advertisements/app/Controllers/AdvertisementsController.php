<?php

namespace App\Controllers;

use App\Middlewares\Authorized;
use Carbon\Carbon;
use Core\Managers\FormValidatorManager\FormValidator;


class AdvertisementsController
{
    public function __construct()
    {
        (new Authorized())->handle();
    }

    public function create()
    {
        $categories = database()->select('categories', '*');

        return view('advertisements/create', ['categories' => $categories]);
    }

    public function edit()
    {
        database()->update('advertisements',
            [
                'user_id' => auth()->user()->id(),
                'category_id' => $_POST['category'],
                'text' => $_POST['text'],
                'accepted_at' => NULL,
                'created_at' => Carbon::now()->format(DATE_ATOM),
                'updated_at' => Carbon::now()->format(DATE_ATOM)
            ],
            ['id' => $_POST['id']]);

        return redirect('submitted');
    }

    public function pendingAds()
    {
        if (AdminController::checkAdminRights()) {
            return view('/admin');
        } else {
            return redirect('advertisements');
        }
    }

    public function viewAds()
    {
        return view('advertisements/index');
    }

    public function showAd()
    {
        return view('advertisements/showAd');
    }

    public function submitted()
    {
        return view('advertisements/submitted');
    }

    public function store()
    {
        formValidate()->validate($_POST, [
            'text' => ['required', 'min:15', 'max:500']
        ]);

        if (formValidate()->failed()) {
            input()->save($_POST);
            flashMessage()->set('Advertisement was not added!');
            return redirect('/advertisements/create');
        }

        database()->insert(
            'advertisements', [
                'user_id' => auth()->user()->id(),
                'category_id' => $_POST['category'],
                'text' => $_POST['text'],
                'accepted_at' => null,
                'created_at' => Carbon::now()->format(DATE_ATOM),
                'updated_at' => Carbon::now()->format(DATE_ATOM),
            ]
        );
        flashMessage()->set('Advertisement created successfully!');
        return redirect('/advertisements/submitted');
    }
}