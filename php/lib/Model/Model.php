<?php

namespace Lib\Model;

abstract class Model
{
    private string $id;

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
