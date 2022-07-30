<?php

namespace Core\UseCase\Product;

use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\UpdateProductInputDto;
use Core\UseCase\DTO\Product\UpdateProductOutputDto;

class UpdateProductUseCase {
    protected ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(UpdateProductInputDto $input): UpdateProductOutputDto {
        $product = $this->repository->findById($input->id);
        $product->update(
            name: $input->name,
            price: $input->price ?? $product->price
        );

        $updatedProduct = $this->repository->update($product);

        return new UpdateProductOutputDto(
            id: $updatedProduct->id,
            name: $updatedProduct->name,
            price: $updatedProduct->price,
            onStock: $updatedProduct->onStock,
        );
    }
}