<?php

namespace Lib\Model;

abstract class Model
{
    private string $id;

    public function __construct(array $attrs, bool $allowNotExisting=false)
    {
        foreach ($attrs as $attr => $value) {
            $setterName = 'set' . ucfirst($attr);
            if (!$allowNotExisting or method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }

    public function getId(): string
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
}
