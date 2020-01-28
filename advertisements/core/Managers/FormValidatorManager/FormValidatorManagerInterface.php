<?php

namespace Core\Managers\FormValidatorManager;

interface FormValidatorManagerInterface
{
    public function validate(array $request, array $formRules = []);

    public function passed(): bool;

    public function failed(): bool;

    public function validateRequired($value, $argument): bool;

    public function validateMin($value, $argument): bool;

    public function validateMax($value, $argument): bool;

}