<?php

namespace Core\UseCase\Product;

use Core\Domain\Entity\Product;
use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\CreateProductInputDto;
use Core\UseCase\DTO\Product\CreateProductOutputDto;

class CreateProductUseCase {
    protected ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(CreateProductInputDto $input): CreateProductOutputDto {
        $product = new Product(
            name: $input->name,
            price: $input->price,
        );

        $newProduct = $this->repository->insert($product);

        return new CreateProductOutputDto(
            id: $newProduct->getId(),
            name: $newProduct->name,
            price: $newProduct->price,
            onStock: $newProduct->onStock,
            createdAt: $newProduct->getCreatedAt()
        );
    }
}