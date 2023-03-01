<?php

namespace TimGa\Fibonacci\Repository;

use Redis;
use RedisException;

class FibonacciRepository
{
    public function __construct(private readonly Redis $redis) {}

    /**
     * @throws RedisException
     */
    public function store(int $key, int $value): void
    {
        $this->redis->set($key, $value);
    }

    /**
     * @throws RedisException
     */
    public function find(int $key): ?int
    {
        $result = $this->redis->get($key);
        if ($result === false) {
            return null;
        }
        return $result;
    }
}
