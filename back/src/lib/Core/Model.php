<?php

namespace Lib\Core;

abstract class Model
{
    abstract public static function getAll(): array;
    abstract public function save();
}
