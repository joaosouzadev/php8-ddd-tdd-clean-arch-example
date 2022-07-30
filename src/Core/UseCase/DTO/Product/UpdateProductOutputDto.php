<?php

namespace Core\UseCase\DTO\Product;

class UpdateProductOutputDto {
    public function __construct(
        public string $id,
        public string $name,
        public float $price,
        public bool $onStock,
    ) {}
}