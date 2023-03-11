<?php

namespace Lib\Data;

class ProductRepository extends Repository
{
    public function __construct(object $pdo)
    {
        parent::__construct($pdo);
    }

    public function getAll()
    {
    }

    public function save($product)
    {
    }

    public function delete(...$product)
    {
    }
}
