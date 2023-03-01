<?php

namespace TimGa\Fibonacci\Infrastructure\Validator\Rules;

use InvalidArgumentException;

class Min implements Rule
{
    public function __construct(private readonly int $min) {}

    public function apply(mixed $value): bool
    {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException('Value must be of integer type');
        }
        return $value >= $this->min;
    }

    public function getMessage(): string
    {
        return sprintf('Value MUST be greater or equals to %s', $this->min);
    }
}
