<?php

namespace TimGa\Fibonacci\Repository;

interface FibonacciRepositoryInterface
{
    public function store(int $key, int $value): void;

    public function find(int $key): ?int;
}
