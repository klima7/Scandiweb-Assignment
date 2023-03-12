<?php

namespace Lib\Model;

use JsonSerializable;
use Lib\Validation\ValidationUtils;

class Book extends Product
{
    private float $weight;

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): void
    {
        ValidationUtils::assertGreaterEqual($weight, "weight", 0);
        $this->weight = $weight;
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'weight' => $this->getWeight(),
        ];
    }
}
