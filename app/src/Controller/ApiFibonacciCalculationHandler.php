<?php

namespace TimGa\Fibonacci\Controller;

use RedisException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use TimGa\Fibonacci\Service\FibonacciCalculator;
use TimGa\Fibonacci\Input;
use TimGa\Fibonacci\Service\InputValidator;

class ApiFibonacciCalculationHandler
{
    public function __construct(private readonly FibonacciCalculator $calculator) {}

    /**
     * @throws RedisException
     */
    public function __invoke(Request $request): Response
    {
        $input = Input::createFromRequest($request);
        $errors = (new InputValidator())->validate($input);

        if (count($errors) > 0) {
            return new JsonResponse(['errors' => $errors], 400);
        }

        $result = $this->calculator->calcFibonacciSequence($input->getFrom(), $input->getTo());
        return new JsonResponse(['result' => implode(', ', $result)], 200);
    }
}
