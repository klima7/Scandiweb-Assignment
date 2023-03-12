<?php

namespace Lib\Model;

use Lib\Data\Database;
use Lib\Validation\ValidationException;
use Lib\Validation\ValidationUtils;

class Product extends Model implements \JsonSerializable
{
    const TYPES = ['book', 'disc', 'furniture'];

    private ?string $sku = null;
    private ?string $name = null;
    private ?float $price = null;

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        ValidationUtils::assertGreaterEqual($sku, "sku", 0);
        $this->sku = $sku;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        ValidationUtils::assertNotBlank($name, "name");
        $this->name = $name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        ValidationUtils::assertGreaterEqual($price, "price", 0);
        ValidationUtils::assertFractionDigitsCount($price, "price", 2);
        $this->price = $price;
    }

    public function jsonSerialize(): array
    {
        return [
                'id' => $this->getId(),
                'sku' => $this->getSku(),
                'name' => $this->getName(),
                'price' => $this->getPrice(),
            ];
    }

    public static function getAll(): array
    {
        $query = "select id, type, sku, name, price, size, weight, height, width, length from products";
        $data = Database::getInstance()->executeAndFetch($query);
        return array_map(fn ($array) => self::cvtArrayToObject($array), $data);
    }

    public static function get($id): ?object
    {
        $query = "select id, type, sku, name, price, size, weight, height, width, length from products where id=?";
        $data = Database::getInstance()->executeAndFetch($query, [$id]);
        return count($data) == 0 ? null : self::cvtArrayToObject($data[0]);
    }

    protected function executeDelete(): void
    {
        $query = "delete from products where id = ?";
        Database::getInstance()->execute($query, [$this->id]);
    }

    protected function executeSave(): int
    {
        $columns = $this->getDatabaseColumns();
        $query = self::constructInsertQuery($columns);
        Database::getInstance()->execute($query, array_values($columns));
        return Database::getInstance()->getLastInsertedId();
    }

    protected function getDatabaseColumns(): array
    {
        return [
            'id' => $this->getId(),
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
        ];
    }

    protected function validate(): void
    {
        ValidationUtils::assertNotNull($this->sku, 'sku');
        ValidationUtils::assertNotNull($this->name, 'name');
        ValidationUtils::assertNotNull($this->price, 'price');
    }

    private static function cvtArrayToObject(array $array): object
    {
        $type = ucfirst($array['type']);
        $fullName = "Lib\\Model\\$type";
        return new $fullName($array);
    }

    private static function constructInsertQuery(array $columns): string
    {
        $columns_names = implode(',', array_keys($columns));
        $values = implode(',', array_fill(0, count($columns), '?'));
        return "insert into products($columns_names) values ($values)";
    }
}
