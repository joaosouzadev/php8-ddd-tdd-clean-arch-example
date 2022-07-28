<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;

class Product {
    use MagicMethodsTrait;

    public function __construct(
        protected string $name,
        protected float $price,
        protected string $id = "",
        protected bool $onStock = true,
    ) {

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
    }
}