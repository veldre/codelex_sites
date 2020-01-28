<?php

namespace Core\Managers\FlashMessageManager;

class MessageManager implements FlashMessageInterface

{
    public static $instance;

    public function __construct()
    {
        self::$instance = $this;
    }

    public function set(string $message): void
    {
        $_SESSION['_flashMessage'] = $message;
    }

    public function get(): ?string
    {
        return $_SESSION['_flashMessage'] ?? null;
    }

    public function clear(): void
    {
        unset($_SESSION['_flashMessage']);
    }
}



