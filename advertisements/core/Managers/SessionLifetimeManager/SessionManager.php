<?php

namespace Core\Managers\SessionLifetimeManager;

class SessionManager
{
    public static function get(): SessionLifetimeManagerInterface
    {
        return new SessionLifetimeManager(time());
    }
}