<?php

namespace Core\Managers\ErrorManager;

class SuperErrorManager implements ErrorManagerInterface
{
    public static $instance;

    public function __construct()
    {
        self::$instance = $this;
    }

    public function add(string $key, string $message): void
    {
        $_SESSION['__errors'][$key] []= $message;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION['__errors'][$key]);
    }

    public function get(string $key): string
    {
        return $_SESSION['__errors'][$key][0];
    }

    public function clear(): void
    {
        $_SESSION['__errors'] = [];
    }

    public function any(): bool
    {
        return ! empty($_SESSION['__errors']);
    }
}