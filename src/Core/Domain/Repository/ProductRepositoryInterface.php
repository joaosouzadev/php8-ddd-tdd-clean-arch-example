<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Product;

interface ProductRepositoryInterface {
    public function insert(Product $product): Product;
    public function findAll(array $filters): array;
    public function findById(string $id): Product;
    public function update(Product $product): Product;
    public function delete(string $id): bool;
    public function hydrate(array $product): Product;
}