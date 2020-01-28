<?php

namespace App;

use Medoo\Medoo;

class Database
{
    private $connection;

    public static $instance;

    public function __construct()
    {
        $this->connection = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'jokes',
            'server' => 'localhost',
            'username' => 'veldre',
            'password' => 'codelex123'
        ]);

        self::$instance = $this;
    }

    public function connection()
    {
        return $this->connection;
    }
}
