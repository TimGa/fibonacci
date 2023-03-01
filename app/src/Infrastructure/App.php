<?php

namespace TimGa\Fibonacci\Infrastructure;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Задача приложения получить запрос и вернуть ответ - это реализованио в методе run
 */
class App
{
    public function __construct(private readonly Router $router, private readonly Container $container) {}

    public function run(Request $request): Response
    {
        $handlerClass = $this->router->getHandlerByRequest($request);
        $handler = $this->container->get($handlerClass);
        return $handler($request);
    }
}
