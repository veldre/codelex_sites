<?php

namespace App\Controllers;

use Carbon\Carbon;
use Core\Database;


class AdminController

{
    public function approve(array $params)
    {
        database()->update("advertisements",
            ["accepted_at" => Carbon::now()->format(Carbon::ATOM)],
            ['id' => $params]);
        return redirect('/admin');
    }

    public function deletePending(array $params)
    {
        database()->delete("advertisements", ["id" => $params]);
        if (self::checkAdminRights()) {
            return redirect('/admin');
        } else {
            return view('/advertisements/deleted');
        }
    }
    public function deleteExisting(array $params)
    {
        database()->delete("advertisements", ["id" => $params]);
        if (self::checkAdminRights()) {
            return redirect('advertisements');
        } else {
            return view('/advertisements/deleted');
        }
    }


    public static function checkAdminRights(): bool
    {
        return ($_SESSION['authentication_key'] === 51);
    }

}