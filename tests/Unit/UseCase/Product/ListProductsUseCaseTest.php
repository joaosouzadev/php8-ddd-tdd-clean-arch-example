<?php

namespace Tests\Unit\UseCase\Product;

use Cassandra\Date;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\ProductsListInputDto;
use Core\UseCase\DTO\Product\ProductsListOutputDto;
use Core\UseCase\Product\ListProductsUseCase;
use PHPUnit\Framework\TestCase;

class ListProductsUseCaseTest extends TestCase {
    public function test_ListProductsEmpty() {
        $this->mockPagination([]);
        $this->mockRepo();

        $this->mockInputDto = \Mockery::mock(ProductsListInputDto::class, []);

        $useCase = new ListProductsUseCase($this->repoForTests);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(ProductsListOutputDto::class, $response);
        $this->assertCount(0, $response->items);

        // spy
        $this->spy = \Mockery::mock(\stdClass::class, ProductRepositoryInterface::class);
        $this->spy->shouldReceive('findAll')->andReturn($this->mockPaginator);
        $useCase = new ListProductsUseCase($this->spy);
        $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findAll');
    }

    public function test_ListProductsNotEmpty() {
        $product = new \stdClass();
        $product->name = "GeForce RTX 3060";
        $product->price = 499.99;
        $product->onStock = true;
        $product->createdAt = (new \DateTime())->format('Y-m-d H:i:s');
        $product->updatedAt = (new \DateTime())->format('Y-m-d H:i:s');

        $this->mockPagination([$product]);
        $this->mockRepo();

        $this->mockInputDto = \Mockery::mock(ProductsListInputDto::class, []);

        $useCase = new ListProductsUseCase($this->repoForTests);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(ProductsListOutputDto::class, $response);
        $this->assertInstanceOf(\stdClass::class, $response->items[0]);
        $this->assertCount(1, $response->items);

        // spy
        $this->spy = \Mockery::mock(\stdClass::class, ProductRepositoryInterface::class);
        $this->spy->shouldReceive('findAll')->andReturn($this->mockPaginator);
        $useCase = new ListProductsUseCase($this->spy);
        $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findAll');
    }

    private function mockRepo(): void {
        $this->repoForTests = \Mockery::mock(\stdClass::class, ProductRepositoryInterface::class);
        $this->repoForTests->shouldReceive('findAll')->andReturn($this->mockPaginator);
    }

    private function mockPagination(array $items = []): void {
        $this->mockPaginator = \Mockery::mock(\stdClass::class, PaginationInterface::class);
        $this->mockPaginator->shouldReceive('items')->andReturn($items);
        $this->mockPaginator->shouldReceive('total')->andReturn(count($items));
        $this->mockPaginator->shouldReceive('currentPage')->andReturn(1);
        $this->mockPaginator->shouldReceive('firstPage')->andReturn(1);
        $this->mockPaginator->shouldReceive('lastPage')->andReturn(1);
        $this->mockPaginator->shouldReceive('perPage')->andReturn(20);
    }

    protected function tearDown(): void {
        \Mockery::close();
        parent::tearDown();
    }
}