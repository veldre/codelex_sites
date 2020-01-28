<?php

namespace Core\Managers\FormValidatorManager;

class FormValidator
{
   public static function instance(): FormValidatorManagerInterface
   {
       return new FormValidatorManager();
   }
}