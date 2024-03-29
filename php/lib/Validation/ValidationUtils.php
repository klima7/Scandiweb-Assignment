<?php

namespace Lib\Validation;

class ValidationUtils
{
    public static function assertNotBlank(string $field, $name)
    {
        if (strlen($field) == 0) {
            throw new ValidationException($name, "can't be blank");
        }
    }

    public static function assertGreaterEqual($field, $name, $value)
    {
        if ($field < $value) {
            throw new ValidationException($name, "must be greater or equal to $value");
        }
    }

    public static function assertFractionDigitsCount(float $field, $name, $maxFractionDigits)
    {
        $fractionDigits = self::getFractionDigitsCount($field);
        if ($fractionDigits > $maxFractionDigits) {
            throw new ValidationException($name, "must have as most $fractionDigits fraction digits");
        }
    }

    public static function assertNotNull($field, $name)
    {
        if ($field == null) {
            throw new ValidationException($name, "value is missing");
        }
    }

    public static function assertHasKey($field, $name, $key)
    {
        if (!array_key_exists($key, $field)) {
            throw new ValidationException($name, "field is missing");
        }
    }

    private static function getFractionDigitsCount($value): int
    {
        $str = (string)$value;
        $pos = strpos($str, '.') ?: (strlen($str)-1);
        return strlen($str) - 1 - $pos;
    }
}
