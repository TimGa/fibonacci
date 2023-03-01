<?php

namespace TimGa\Fibonacci\Service;

use RedisException;
use TimGa\Fibonacci\Repository\FibonacciRepository;

class FibonacciCalculator
{
    public function __construct(private readonly FibonacciRepository $repository) {}

    /**
     * Запускает рекурсивный метод расчёта Фибоначчи для указанной последовательности
     * @throws RedisException
     */
    public function calcFibonacciSequence(int $from, int $to): array
    {
        $result = [];
        while ($from <= $to) {
            $result[] = $this->calcFibonacci($from);
            $from++;
        }
        return $result;
    }

    /**
     * Расчет Фибоначи для конкретного числа с использованием хранилища для сохранения новых рассчитанных значений,
     * или для полученее старых ранее рассчитанных значений
     * @throws RedisException
     */
    public function calcFibonacci(int $num): int
    {
        if ($num === 0) {
            return 0;
        }
        if ($num === 1) {
            return 1;
        }
        $cached = $this->repository->find($num);
        if ($cached !== null) {
            return $cached;
        }

        $result = $this->calcFibonacci($num - 2) + $this->calcFibonacci($num - 1);
        $this->repository->store($num, $result);
        return $result;
    }
}
