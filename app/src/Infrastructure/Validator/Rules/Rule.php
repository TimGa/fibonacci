<?php

namespace TimGa\Fibonacci\Infrastructure\Validator\Rules;

/**
 * Правило для проверки значений
 */
interface Rule
{
    /**
     * Реализует логику проверки для данного Rule.
     * @param mixed $value Проверяемое значение
     * @return bool возвращает false в случае неуспешной проверки, true - в случае успешной
     */
    public function apply(mixed $value): bool;

    /**
     * Выводит сообщение об ошибке валидации в случае ошибки валидации.
     * @return string Сообщение об ошибке валидации
     */
    public function getMessage(): string;
}
