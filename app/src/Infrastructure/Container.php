<?php

namespace TimGa\Fibonacci\Infrastructure;

use LogicException;
use Redis;
use TimGa\Fibonacci\Controller\ApiFibonacciCalculationHandler;
use TimGa\Fibonacci\Controller\WebFibonacciUiCheckHandler;
use TimGa\Fibonacci\Controller\WebNotFoundHandler;
use TimGa\Fibonacci\Repository\FibonacciRepository;
use TimGa\Fibonacci\Service\FibonacciCalculator;

/**
 * Очень упрощенная реализация DI контейнера.
 * Можно установить сторонний пакет, но данной реализации хватает.
 */
class Container
{
    /**
     * Хранилище контейнера - здесь вся логика DI
     * В качестве ключа выступает имя класса, который нужно получить из контенера
     * В качестве значения - колбэк, который создаст нужный инстанс
     * @var array
     */
    private array $storage = [];

    public function __construct()
    {
        $this->storage[ApiFibonacciCalculationHandler::class] = function() {
            $redis = new Redis();
            $redis->connect('redis');
            $repository = new FibonacciRepository($redis);
            $calculator = new FibonacciCalculator($repository);
            return new ApiFibonacciCalculationHandler($calculator);
        };
        $this->storage[WebFibonacciUiCheckHandler::class] = function() {
            return new WebFibonacciUiCheckHandler();
        };
        $this->storage[WebNotFoundHandler::class] = function() {
            return new WebNotFoundHandler();
        };
    }

    public function get(string $className): mixed
    {
        if (!isset($this->storage[$className])) {
            throw new LogicException($className.' not found in DI container');
        }
        return $this->storage[$className]();
    }
}
