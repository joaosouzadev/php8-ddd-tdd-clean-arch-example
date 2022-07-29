<?php

namespace Core\UseCase\DTO\Product;

class ProductsListInputDto {
    public function __construct(
        public array $filters = [],
        public string $orderBy = '',
        public int $page = 1,
        public int $perPage = 20
    ) {}
}