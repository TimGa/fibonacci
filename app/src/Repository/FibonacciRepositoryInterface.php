<?php

namespace TimGa\Fibonacci\Repository;

interface FibonacciRepositoryInterface
{
    public function store(int $key, string $value): void;

    public function find(int $key): ?string;
}
