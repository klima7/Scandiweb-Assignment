<?php

namespace Lib\Model;

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
}
