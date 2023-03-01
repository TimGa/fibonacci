<?php

namespace TimGa\Fibonacci\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebFibonacciUiCheckHandler
{
    const TEMPLATE_PATH = '../templates/fibonacci_check_form.php';

    public function __invoke(Request $request): Response
    {
        ob_start();
        include self::TEMPLATE_PATH;
        $template = ob_get_clean();
        return new Response($template, 200);
    }
}
