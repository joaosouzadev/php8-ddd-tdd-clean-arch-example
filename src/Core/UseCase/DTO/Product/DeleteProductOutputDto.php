<?php

namespace Core\UseCase\DTO\Product;

class DeleteProductOutputDto {
    public function __construct(
        public bool $success,
    ) {}
}