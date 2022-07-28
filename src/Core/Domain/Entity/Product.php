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
}