<?php

namespace Lib\Data;

abstract class Repository
{
    protected object $pdo;

    public function __construct(object $pdo)
    {
        $this->pdo = $pdo;
    }
}
