<?php

namespace Tests\Unit\UseCase\Product;

use Core\Domain\Entity\Product;
use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\CreateProductInputDto;
use Core\UseCase\DTO\Product\CreateProductOutputDto;
use Core\UseCase\Product\CreateProductUseCase;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateProductUseCaseTest extends TestCase {
    public function test_CreateNewProduct() {
        $uuid = Uuid::uuid4();
        $this->mockEntity = \Mockery::mock(Product::class, [
            "GeForce RTX 3060",
            499.99,
            $uuid,
        ]);
        $this->mockEntity->shouldReceive('getId')->andReturn($uuid);
        $this->mockEntity->shouldReceive('getCreatedAt')->andReturn($this->mockEntity->createdAt->format('Y-m-d H:i:s'));
        $this->mockEntity->shouldReceive('getUpdatedAt')->andReturn($this->mockEntity->updatedAt->format('Y-m-d H:i:s'));

        $this->repoForTests = \Mockery::mock(\stdClass::class, ProductRepositoryInterface::class);
        $this->repoForTests->shouldReceive('insert')->andReturn($this->mockEntity);

        $this->mockInputDto = \Mockery::mock(CreateProductInputDto::class, [
            "GeForce RTX 3060",
            499.99,
        ]);

        $useCase = new CreateProductUseCase($this->repoForTests);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CreateProductOutputDto::class, $response);
        $this->assertEquals($this->mockInputDto->name, $response->name);
        $this->assertEquals($this->mockInputDto->price, $response->price);

        // spy
        $this->spy = \Mockery::spy(\stdClass::class, ProductRepositoryInterface::class);
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);
        $useCase = new CreateProductUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('insert');

        \Mockery::close();
    }
}