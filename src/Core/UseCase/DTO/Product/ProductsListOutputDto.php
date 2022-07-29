<?php

namespace Core\UseCase\DTO\Product;

class ProductsListOutputDto {
    public function __construct(
        public array $items,
        public int $total,
        public int $firstPage,
        public int $lastPage,
        public int $currentPage,
        public int $perPage,
    ) {}
}