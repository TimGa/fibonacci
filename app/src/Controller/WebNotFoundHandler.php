<?php

namespace TimGa\Fibonacci\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebNotFoundHandler
{
    const TEMPLATE_PATH = '../templates/not_found.php';

    public function __invoke(Request $request): Response
    {
        ob_start();
        include self::TEMPLATE_PATH;
        $template = ob_get_clean();
        return new Response($template, 404);
    }
}
