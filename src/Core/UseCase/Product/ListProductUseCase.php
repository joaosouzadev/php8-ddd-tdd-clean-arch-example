<?php

namespace Core\UseCase\Product;

use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\ProductInputDto;
use Core\UseCase\DTO\Product\ProductOutputDto;

class ListProductUseCase {
    protected ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(ProductInputDto $input): ProductOutputDto {
        $product = $this->repository->findById($input->id);

        return new ProductOutputDto(
            id: $product->id,
            name: $product->name,
            price: $product->price,
            onStock: $product->onStock,
            createdAt: $product->getCreatedAt()
        );
    }
}