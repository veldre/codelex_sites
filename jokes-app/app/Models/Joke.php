<?php

namespace App\Models;

use App\Database;
use Carbon\Carbon;

class Joke
{
    public $id;
    public $name;
    public $content;
    public $createdAt;
    public $acceptedAt;


    public function __construct($id, string $name, string $content, string $createdAt, $acceptedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->acceptedAt = $acceptedAt;
    }

    public function id()
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function created_at()
    {
        return $this->createdAt;
    }

    public function accepted_at()
    {
        return $this->acceptedAt;
    }



}
