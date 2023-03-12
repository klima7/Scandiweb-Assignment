<?php

namespace Lib\Model;

use Lib\Validation\ValidationUtils;

class Product extends Model
{
    private ?string $sku = null;
    private ?string $name = null;
    private ?float $price = null;

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        ValidationUtils::assertGreaterEqual($sku, "SKU", 0);
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

    public function validate()
    {
        ValidationUtils::assertNotNull($this->sku, 'sku');
        ValidationUtils::assertNotNull($this->name, 'name');
        ValidationUtils::assertNotNull($this->price, 'price');
    }


    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
        ];
    }
}
