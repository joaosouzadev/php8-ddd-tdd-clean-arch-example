<?php

namespace Core\UseCase\DTO\Product;

class CreateProductInputDto {
    public function __construct(
        public string $name,
        public float $price,
        public bool $onStock = true
    ) {

    }
}