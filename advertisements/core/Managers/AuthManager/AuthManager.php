<?php

namespace Core\Managers\AuthManager;

class AuthManager
{
    public static function authenticate(): AuthManagerInterface
    {
        return new SuperAuthManager();
    }
}