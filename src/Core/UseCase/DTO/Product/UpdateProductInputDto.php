<?php

namespace Core\UseCase\DTO\Product;

class UpdateProductInputDto {
    public function __construct(
        public string $id,
        public string $name,
        public float|null $price = null,
        public bool|null $onStock = null,
    ) {}
}