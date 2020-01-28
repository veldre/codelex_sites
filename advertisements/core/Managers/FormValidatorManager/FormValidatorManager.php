<?php

namespace Core\Managers\FormValidatorManager;

class FormValidatorManager implements FormValidatorManagerInterface
{
    public function validate(array $request, array $formRules = [])
    {
        foreach ($request as $formKey => $formValue)
        {
            $rules = $formRules[$formKey] ?? [];

            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $method = $rule[0];
                $argument = $rule[1] ?? null;
                $validateMethodName = 'validate' . ucfirst($method);

                if (! $this->$validateMethodName($formValue, $argument)) {
                    $message = config("errors.$method", 'Validation failed.');
                    $message = str_replace(
                        ['[FIELD]', '[ARGUMENT]'],
                        [$formKey, $argument],
                        $message
                    );

                    errors()->add($formKey, $message);
                }
            }
        }
    }

    public function passed(): bool
    {
        return ! errors()->any();
    }

    public function failed(): bool
    {
        return ! $this->passed();
    }

    public function validateRequired($value, $argument): bool
    {
        return ! empty($value);
    }

    public function validateMin($value, $argument): bool
    {
        return strlen($value) >= (int) $argument;
    }

    public function validateMax($value, $argument): bool
    {
        return strlen($value) <= (int) $argument;
    }
}