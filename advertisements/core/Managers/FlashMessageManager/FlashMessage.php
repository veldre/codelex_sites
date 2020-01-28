<?php

namespace Core\Managers\FlashMessageManager;

class FlashMessage
{
    public static function message(): FlashMessageInterface
    {
        return new MessageManager();
    }
}