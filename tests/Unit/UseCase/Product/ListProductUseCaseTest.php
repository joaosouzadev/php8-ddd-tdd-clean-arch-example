<?php

namespace Tests\Unit\UseCase\Product;

use Core\Domain\Entity\Product;
use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\ProductInputDto;
use Core\UseCase\DTO\Product\ProductOutputDto;
use Core\UseCase\Product\ListProductUseCase;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ListProductUseCaseTest extends TestCase {
    public function test_GetById() {
        $id = Uuid::uuid4()->toString();
        $this->mockEntity = \Mockery::mock(Product::class, [
            "GeForce RTX 3060",
            499.99,
            $id,
        ]);
        $this->mockEntity->shouldReceive('getCreatedAt')->andReturn($this->mockEntity->createdAt->format('Y-m-d H:i:s'));

        $this->repoForTests = \Mockery::mock(\stdClass::class, ProductRepositoryInterface::class);
        $this->repoForTests->shouldReceive('findById')->with($id)->andReturn($this->mockEntity);

        $this->mockInputDto = \Mockery::mock(ProductInputDto::class, [
            $id
        ]);

        $useCase = new ListProductUseCase($this->repoForTests);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(ProductOutputDto::class, $response);
        $this->assertEquals($this->mockEntity->id, $response->id);
        $this->assertEquals($this->mockEntity->name, $response->name);
        $this->assertEquals($this->mockEntity->price, $response->price);

        // spy
        $this->spy = \Mockery::mock(\stdClass::class, ProductRepositoryInterface::class);
        $this->spy->shouldReceive('findById')->with($id)->andReturn($this->mockEntity);
        $useCase = new ListProductUseCase($this->spy);
        $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findById');
    }

    protected function tearDown(): void {
        \Mockery::close();
        parent::tearDown();
    }
}