<?php

namespace TimGa\Fibonacci\Repository;

use Redis;
use RedisException;

class FibonacciRepository implements FibonacciRepositoryInterface
{
    public function __construct(private readonly Redis $redis) {}

    /**
     * @throws RedisException
     */
    public function store(int $key, string $value): void
    {
        $this->redis->set($key, $value);
    }

    /**
     * @throws RedisException
     */
    public function find(int $key): ?string
    {
        $result = $this->redis->get($key);
        if ($result === false) {
            return null;
        }
        return $result;
    }
}
