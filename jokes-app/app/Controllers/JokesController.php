<?php

namespace App\Controllers;

use App\Database;
use Carbon\Carbon;

class JokesController
{
    public function index(array $params)
    {
        return view('jokes/index');
    }

    public function create(array $params)
    {
        return view('jokes/create');
    }

    public function admin(array $params)
    {
        return view('jokes/admin');
    }

    public function approved(array $params)
    {
        return view('jokes/approved');
    }

    public function deleted(array $params)
    {
        return view('jokes/deleted');
    }

    public function deleteold(array $params)
    {
        return view('jokes/deleteold');
    }

    public function store(array $params)
    {
        $name = $_POST['name'] ?? null;
        $content = $_POST['content'] ?? null;

        if (empty($name) || empty($content)) {
            return redirect('/jokes/create');
        }
        // validate
        Database::$instance->connection()->insert('jokes', [
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created_at' => Carbon::now()->format(Carbon::ATOM),
            'accepted_at' => null,
        ]);
        return redirect('/jokes');
    }

    public function approve(array $params)
    {
        Database::$instance->connection()->update("jokes", ["accepted_at" => Carbon::now()->format(Carbon::ATOM)], ['id' => $params]);
        return redirect('/jokes/approved');
    }

    public function delete(array $params)
    {
        Database::$instance->connection()->delete("jokes", ["id" => $params]);
        return redirect('/jokes/deleted');
    }
}
