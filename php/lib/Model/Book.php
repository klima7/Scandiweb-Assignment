<?php

namespace Lib\Model;

use JsonSerializable;
use Lib\Validation\ValidationUtils;

class Book extends Product
{
    private ?float $weight = null;

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): void
    {
        ValidationUtils::assertGreaterEqual($weight, "weight", 0);
        $this->weight = $weight;
    }

    public function validate(): void
    {
        parent::validate();
        ValidationUtils::assertNotNull($this->weight, "weight");
    }


    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'type' => 'book',
            'weight' => $this->getWeight(),
        ];
    }

    protected function getDatabaseColumns(): array
    {
        return parent::getDatabaseColumns() + [
            'type' => 'book',
            'weight' => $this->getWeight(),
        ];
    }
}
