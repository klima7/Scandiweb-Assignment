<?php

namespace Lib\Model;

use Lib\Validation\ValidationUtils;

class Disc extends Product
{
    private ?float $size = null;

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): void
    {
        ValidationUtils::assertGreaterEqual($size, "size", 0);
        $this->size = $size;
    }

    public function validate()
    {
        parent::validate();
        ValidationUtils::assertNotNull($this->size, "size");
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'size' => $this->getSize(),
        ];
    }
}
