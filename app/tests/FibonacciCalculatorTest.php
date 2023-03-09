<?php

use PHPUnit\Framework\TestCase;
use TimGa\Fibonacci\Repository\FibonacciRepositoryInterface;
use TimGa\Fibonacci\Service\FibonacciCalculator;

class FibonacciCalculatorTest extends TestCase
{
    public function testCalcFibonacci()
    {
        $repository = new FibonacciArrayRepository();
        $calculator = new FibonacciCalculator($repository);
        $fibonacci = $calculator->calcFibonacci(9);
        $this->assertEquals('34', $fibonacci);
        $this->assertEquals('34', $repository->find(9));
        $this->assertEquals(null, $repository->find(10));
    }

    public function testCalcFibonacciSequence()
    {
        $repository = new FibonacciArrayRepository();
        $calculator = new FibonacciCalculator($repository);
        $fibonacciSequence = $calculator->calcFibonacciSequence(3, 6);
        $this->assertEquals(['2','3','5','8'], $fibonacciSequence);
        $this->assertEquals('8', $repository->find(6));
        $this->assertEquals(null, $repository->find(7));
    }

    public function testCalcLongFibonacci()
    {
        $repository = new FibonacciArrayRepository();
        $calculator = new FibonacciCalculator($repository);
        $fibonacci = $calculator->calcFibonacci(250);
        $this->assertEquals('7896325826131730509282738943634332893686268675876375', $fibonacci);
        $this->assertEquals('7896325826131730509282738943634332893686268675876375', $repository->find(250));
        $this->assertEquals(null, $repository->find(251));
    }
}

class FibonacciArrayRepository implements FibonacciRepositoryInterface
{
    private array $storage = [];

    public function store(int $key, string $value): void
    {
        $this->storage[$key] = $value;
    }

    public function find(int $key): ?string
    {
        return $this->storage[$key] ?? null;
    }
}
