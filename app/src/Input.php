<?php

namespace TimGa\Fibonacci;

use Symfony\Component\HttpFoundation\Request;

class Input
{
    private int $from;
    private int $to;

    /**
     * @param int $from
     * @param int $to
     */
    public function __construct(int $from, int $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public static function createFromRequest(Request $request): self
    {
        return new self(
            (int)$request->query->get('from'),
            (int)$request->query->get('to'),
        );
    }

    /**
     * @return int
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * @return int
     */
    public function getTo(): int
    {
        return $this->to;
    }
}
