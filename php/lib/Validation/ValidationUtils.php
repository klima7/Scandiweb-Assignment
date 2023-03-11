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

    public static function assertFractionDigitsCount(float $field, $name, $fractionDigits)
    {
        if (fmod($field * 10**$fractionDigits, 1)) {
            throw new ValidationException("$name must have as most $fractionDigits fraction digits");
        }
    }
}
