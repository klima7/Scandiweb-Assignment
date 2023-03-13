<?php

namespace Lib\Validation;

use Exception;

class ValidationException extends Exception
{
    private string $field;
    private string $error;

    public function __construct(string $field, string $error, int $code=0, ?object $previous = null)
    {
        parent::__construct("$field: $error", $code, $previous);
        $this->field = $field;
        $this->error = $error;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getError(): string
    {
        return $this->error;
    }
}
