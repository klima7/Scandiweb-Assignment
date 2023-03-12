<?php

namespace Lib\Model;

use Lib\Validation\ValidationUtils;

class Furniture extends Product
{
    private float $height;
    private float $width;
    private float $length;

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $height): void
    {
        ValidationUtils::assertGreaterEqual($height, "height", 0);
        $this->height = $height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setWidth(float $width): void
    {
        ValidationUtils::assertGreaterEqual($width, "width", 0);
        $this->width = $width;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function setLength(float $length): void
    {
        ValidationUtils::assertGreaterEqual($length, "length", 0);
        $this->length = $length;
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'height' => $this->getHeight(),
            'width' => $this->getWidth(),
            'length' => $this->getLength(),
        ];
    }
}
