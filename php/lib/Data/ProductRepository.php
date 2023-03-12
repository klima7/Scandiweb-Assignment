<?php

namespace Lib\Data;

use PDO;
use ReflectionClass;

class ProductRepository extends Repository
{
    private object $getAllStatement;
    private object $getStatement;
    private object $insertStatement;
    private object $deleteStatement;

    public function __construct(object $pdo)
    {
        parent::__construct($pdo);
        $this->getAllStatement = $this->createGetAllStatement();
        $this->getStatement = $this->createGetStatement();
        $this->insertStatement = $this->createInsertStatement();
        $this->deleteStatement = $this->createDeleteStatement();
    }

    public function getAll(): array
    {
        $productsArrays = $this->getAllStatement->fetchAll();
        return array_map(fn ($productArray) => self::cvtArrayToObject($productArray), $productsArrays);
    }

    public function get(int $id): ?object
    {
        $this->getStatement->execute(['id' => $id]);
        $productsArrays = $this->getStatement->fetchAll();
        if (count($productsArrays) == 0) {
            return null;
        }
        return self::cvtArrayToObject($productsArrays[0]);
    }

    public function save($product)
    {
        $product->validate();
        $data = array_fill_keys(['sku', 'name', 'price', 'size', 'weight', 'height', 'width', 'length'], null);
        $data['type'] = strtolower((new ReflectionClass($product))->getShortName());
        $data = array_merge($data, $product->jsonSerialize());
        $this->insertStatement->execute($data);
        $product->setId($this->getPdo()->lastInsertId());
    }

    public function delete($product)
    {
        $id = $product->getId();
        if ($id != null) {
            $this->deleteStatement->execute([$id]);
            $product->clearId();
        }
    }

    private function createGetAllStatement()
    {
        $query = "select id, type, sku, name, price, size, weight, height, width, length from products";
        $statement = $this->getPdo()->query($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement;
    }

    private function createGetStatement()
    {
        $query = "select id, type, sku, name, price, size, weight, height, width, length from products where id = :id";
        $statement = $this->getPdo()->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement;
    }

    private function createInsertStatement()
    {
        $query = <<<SQL
        insert into products(id, type, sku, name, price, size, weight, height, width, length) 
        values(:id, :type, :sku, :name, :price, :size, :weight, :height, :width, :length)
        SQL;
        return $this->getPdo()->prepare($query);
    }

    private function createDeleteStatement()
    {
        $query = "delete from products where id = ?";
        return $this->getPdo()->prepare($query);
    }

    private static function cvtArrayToObject(array $array)
    {
        $type = ucfirst($array['type']);
        $fullName = "Lib\\Model\\$type";
        return new $fullName($array, true);
    }
}
