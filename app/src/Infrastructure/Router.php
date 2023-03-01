<?php

namespace TimGa\Fibonacci\Infrastructure;

use Symfony\Component\HttpFoundation\Request;
use TimGa\Fibonacci\Controller\ApiFibonacciCalculationHandler;
use TimGa\Fibonacci\Controller\WebFibonacciUiCheckHandler;
use TimGa\Fibonacci\Controller\WebNotFoundHandler;

/**
 * Примитивный роутер - в себе хранит мапинг маршрутов и соответствующие им классы-обработчики
 */
class Router
{
    const ROUTES = [
        '/fibonacci' => ApiFibonacciCalculationHandler::class,
        '/' => WebFibonacciUiCheckHandler::class,
    ];

    /**
     * @param Request $request
     * @return string Класс-обработчик роута
     */
    public function getHandlerByRequest(Request $request): string
    {
        $searchUri = explode('?', $request->getRequestUri())[0];

        if (!isset(self::ROUTES[$searchUri])) {
            return WebNotFoundHandler::class;
        }

        return self::ROUTES[$searchUri];
    }
}
