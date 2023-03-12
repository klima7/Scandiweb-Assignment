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

    public function validate(): void
    {
        parent::validate();
        ValidationUtils::assertNotNull($this->size, "size");
    }

    protected function getAttributesArray(): array
    {
        return parent::getAttributesArray() + [
            'type' => 'disc',
            'size' => $this->getSize(),
        ];
    }
}
