<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;

class Product {
    use MagicMethodsTrait;

    public function __construct(
        protected string $name,
        protected float $price,
        protected Uuid|string $id = "",
        protected bool $onStock = true,
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::newUuid();
        $this->validate();
    }

    public function removeFromStock(): void {
        $this->onStock = false;
    }

    public function addOnStock(): void {
        $this->onStock = true;
    }

    public function update(string $name, float $price = null): void {
        $this->name = $name;
        $this->price = $price ?? $this->price;
        $this->validate();
    }

    public function validate(): void {
        DomainValidation::notEmpty($this->name);
        DomainValidation::positiveNumber($this->price);
    }
}