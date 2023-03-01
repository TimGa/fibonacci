<?php

use Symfony\Component\HttpFoundation\Request;
use TimGa\Fibonacci\Infrastructure\App;
use TimGa\Fibonacci\Infrastructure\Container;
use TimGa\Fibonacci\Infrastructure\Router;

require_once '../vendor/autoload.php';

$request = Request::createFromGlobals();
$app = new App(new Router(), new Container());
$app->run($request)->send();
