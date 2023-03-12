<?php

namespace Lib\Data;

abstract class Repository
{
    private object $pdo;

    public function __construct(object $pdo)
    {
        $this->pdo = $pdo;
    }

    protected function getPdo(): object
    {
        return $this->pdo;
    }
}
