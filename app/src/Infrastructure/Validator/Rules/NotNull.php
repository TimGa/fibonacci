<?php

namespace TimGa\Fibonacci\Infrastructure\Validator\Rules;

class NotNull implements Rule
{

    public function apply(mixed $value): bool
    {
        if ($value === "" || !isset($value)) {
            return false;
        }
        return true;
    }

    public function getMessage(): string
    {
        return 'Value MUST NOT be empty';
    }
}
