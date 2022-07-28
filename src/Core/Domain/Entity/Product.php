<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;

class Product {
    use MagicMethodsTrait;

    public function __construct(
        protected string $name,
        protected float $price,
        protected string $id = "",
        protected bool $onStock = true,
    ) {
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