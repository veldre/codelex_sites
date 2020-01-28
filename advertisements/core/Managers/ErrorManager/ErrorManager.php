<?php

namespace Core\Managers\ErrorManager;

class ErrorManager
{
    public static function instance(): ErrorManagerInterface
    {
        return new SuperErrorManager();
    }
}