<?php

namespace Lib\Validation;

class ValidationUtils
{
    public static function assertNotBlank(string $field, $name)
    {
        if (strlen($field) == 0) {
            throw new ValidationException("$name can't be blank");
        }
    }

    public static function assertGreaterEqual($field, $name, $value)
    {
        if ($field < $value) {
            throw new ValidationException("$name must be greater or equal to $value");
        }
    }

    public static function assertFractionDigitsCount(float $field, $name, $maxFractionDigits)
    {
        $fractionDigits = self::getFractionDigitsCount($field);
        if ($fractionDigits > $maxFractionDigits) {
            throw new ValidationException("$name must have as most $fractionDigits fraction digits");
        }
    }

    private static function getFractionDigitsCount($value): int
    {
        $str = (string)$value;
        $pos = strpos($str, '.') ?: (strlen($str)-1);
        return strlen($str) - 1 - $pos;
    }
}
