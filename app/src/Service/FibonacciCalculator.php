<?php

namespace TimGa\Fibonacci\Service;

use RedisException;
use TimGa\Fibonacci\Repository\FibonacciRepositoryInterface;

class FibonacciCalculator
{
    public function __construct(private readonly FibonacciRepositoryInterface $repository) {}

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
    public function calcFibonacci(int $num): string
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

        $result = $this->sumStringifiedIntegers($this->calcFibonacci($num - 2), $this->calcFibonacci($num - 1));
        $this->repository->store($num, $result);
        return $result;
    }

    /**
     * Метод ссумирует числа, записанные в виде строки
     * Число, которое можно положить в int64 - ограничено: в таком случае невозможно посчитать число Фибоначчи для >92
     * Поэтому числа пришлось перевести в string, чтобы их длинна не ограничивалась
     */
    public function sumStringifiedIntegers(string $a, string $b): string
    {
        $a = array_reverse(str_split($a));
        $b = array_reverse(str_split($b));
        $result = [];
        $ten = 0;

        $len = (max(count($a), count($b)));

        for ($i=0; $i<$len; $i++) {
            $aDigit = $a[$i] ?? 0;
            $bDigit = $b[$i] ?? 0;
            $sumDigit = $aDigit + $bDigit + $ten;
            $ten = 0;
            if ($sumDigit > 9) {
                $ten = 1;
                $sumDigit = $sumDigit % 10;
            }
            $result[] = $sumDigit;
        }
        if ($ten === 1) {
            $result[] = 1;
        }

        return implode('', array_reverse($result));
    }
}
