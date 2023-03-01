<?php

namespace TimGa\Fibonacci\Infrastructure\Validator;

use TimGa\Fibonacci\Infrastructure\Validator\Rules\Rule;

/**
 * Примитивный валидатор - первая реализация которая пришла в голову.
 * Получилось неочень, но свою функцию выполняет.
 * Не стал устанавливать готовый пакет валидации, т.к. ради интереса решил написать своё.
 */
interface Validator
{
    /**
     * Результатом выполнения функции должен быть массив сообщений с ошибками.
     * Если ошибок не обнаружено, то возвращается пустой массив.
     * @param mixed $value Валидируемый объект
     * @return string[] Массив сообщений об ошибках валидации
     */
    public function validate(mixed $value): array;

    /**
     * Применяет указанный массив правил $rules на проверяемом значении $value.
     * В случае ошибок валидации, сообщения об ошибках можно получить через Rule->getMessage() и сохранить
     * их в массив ошибок валидатора.
     * @param mixed $value Значение, которое проверяется
     * @param string $name Имя для идентификации проверяемого значения $value
     * @param Rule[] $rules Массив правил для проверки значения $value
     */
    public function applyRules(mixed $value, string $name, array $rules): void;
}
