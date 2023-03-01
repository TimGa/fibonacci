<?php

namespace TimGa\Fibonacci\Infrastructure\Validator\Rules;

use InvalidArgumentException;

class Max implements Rule
{
    public function __construct(private readonly int $max) {}

    public function apply(mixed $value): bool
    {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException('Value must be of integer type');
        }
        return $value <= $this->max;
    }

    public function getMessage(): string
    {
        return sprintf('Value MUST be less or equals to %s', $this->max);
    }
}
