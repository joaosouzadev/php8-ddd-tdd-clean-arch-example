<?php

namespace Core\UseCase\Product;

use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\ProductsListInputDto;
use Core\UseCase\DTO\Product\ProductsListOutputDto;

class ListProductsUseCase {
    protected ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(ProductsListInputDto $input): ProductsListOutputDto {
        $products = $this->repository->findAll(
            filters: $input->filters,
            orderBy: $input->orderBy,
            page: $input->page,
            perPage: $input->perPage
        );

        return new ProductsListOutputDto(
            items: $products->items(),
            total: $products->total(),
            firstPage: $products->firstPage(),
            lastPage: $products->lastPage(),
            currentPage: $products->currentPage(),
            perPage: $products->perPage()
        );
    }
}