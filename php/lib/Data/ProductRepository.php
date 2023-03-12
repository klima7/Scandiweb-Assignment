<?php

namespace Lib\Data;

use PDO;

class ProductRepository extends Repository
{
    private object $getAllStatement;

    public function __construct(object $pdo)
    {
        parent::__construct($pdo);
        $this->getAllStatement = $this->createGetAllStatement();
    }

    public function getAll(): array
    {
        $productsArrays = $this->getAllStatement->fetchAll();
        return array_map(function ($productArray) {
            $type = ucfirst($productArray['type']);
            $fullName = "Lib\\Model\\$type";
            return new $fullName($productArray, true);
        }, $productsArrays);
    }

    public function save($product)
    {
    }

    public function delete(...$product)
    {
    }

    private function createGetAllStatement()
    {
        $query = "select id, type, sku, name, price, size, weight, height, width, length from products";
        $statement = $this->getPdo()->query($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement;
    }
}
