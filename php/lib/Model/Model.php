<?php

namespace Lib\Model;

use JsonSerializable;

abstract class Model implements JsonSerializable
{
    private ?string $id = null;

    public function __construct(array $attrs, bool $allowNotExisting=false)
    {
        foreach ($attrs as $attr => $value) {
            $setterName = 'set' . ucfirst($attr);
            if (!$allowNotExisting or method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function clearId(): void
    {
        $this->id = null;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId()
        ];
    }

    public function validate()
    {
    }
}
