<?php

namespace TimGa\Fibonacci\Service;

use TimGa\Fibonacci\Infrastructure\Validator\Rules\Max;
use TimGa\Fibonacci\Infrastructure\Validator\Rules\Min;
use TimGa\Fibonacci\Infrastructure\Validator\Rules\NotNull;
use TimGa\Fibonacci\Infrastructure\Validator\Validator;
use TimGa\Fibonacci\Input;

class InputValidator implements Validator
{
    /**
     * @var string[] Хранит все ошибки валидации
     */
    private array $errors = [];

    /**
     * Расчёт Фибоначчи для 10 000 занимет несколько секунд -
     * в этом случае будет заменто наличие кэширования при выполнении повторных расчётов
     */
    private const MAX_FIBONACCI = 10000;

    /**
     * @param Input $input Пришло от пользователя
     * @return string[] Список ошибок
     */
    public function validate(mixed $input): array
    {
        $this->applyRules($input->getTo(), 'to', [new Max(self::MAX_FIBONACCI), new Min(0), new NotNull()]);
        $this->applyRules($input->getFrom(), 'from', [new Max(self::MAX_FIBONACCI), new Min(0), new NotNull()]);
        $this->isToGreaterOrEqualsToFrom($input);
        return $this->errors;
    }

    /**
     * @inheritdoc
     */
    public function applyRules(mixed $value, string $name, array $rules): void
    {
        foreach ($rules as $rule) {
            if (!$rule->apply($value)) {
                $this->errors[] = sprintf('%s: %s',$name, $rule->getMessage());
            }
        }
    }

    /**
     * Значение 'to' должно быть больше или равно значению 'from'
     * @param Input $input
     */
    private function isToGreaterOrEqualsToFrom(Input $input): void
    {
        if ($input->getTo() < $input->getFrom()) {
            $this->errors[] = '"to" MUST NOT be less than "from"';
        }
    }
}
