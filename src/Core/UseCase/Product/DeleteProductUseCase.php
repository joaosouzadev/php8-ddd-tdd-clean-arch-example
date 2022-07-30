<?php

namespace Core\UseCase\Product;

use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\DeleteProductOutputDto;
use Core\UseCase\DTO\Product\ProductInputDto;

class DeleteProductUseCase {
    protected ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(ProductInputDto $input): DeleteProductOutputDto {
        $success = $this->repository->delete($input->id);

        return new DeleteProductOutputDto($success);
    }
}