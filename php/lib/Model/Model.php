<?php

namespace Lib\Model;

abstract class Model
{
    protected ?int $id = null;

    public function __construct(array $attrs)
    {
        foreach ($attrs as $attr => $value) {
            $setterName = 'set' . ucfirst($attr);
            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function save(): void
    {
        $this->validate();
        $id = $this->executeSave();
        $this->id = $id;
    }

    public function delete(): void
    {
        $this->executeDelete();
        $this->id = null;
    }

    abstract public static function getAll(): array;

    abstract public static function get($id): ?object;

    abstract protected function executeSave(): int;

    abstract protected function executeDelete(): void;

    abstract protected function validate(): void;
}
