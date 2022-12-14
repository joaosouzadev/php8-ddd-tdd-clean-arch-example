<?php

namespace Tests\Unit\UseCase\Product;

use Core\Domain\Entity\Product;
use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\UpdateProductInputDto;
use Core\UseCase\DTO\Product\UpdateProductOutputDto;
use Core\UseCase\Product\UpdateProductUseCase;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UpdateProductUseCaseTest extends TestCase {
    public function test_RenameProduct() {
        $id = Uuid::uuid4()->toString();
        $this->mockEntity = \Mockery::mock(Product::class, [
            "GeForce RTX 3060",
            499.99,
            $id,
        ]);
        $this->mockEntity->shouldReceive('update');

        $this->mockEntityUpdated = \Mockery::mock(Product::class, [
            "GeForce RTX 3060 TI",
            499.99,
        ]);

        $this->repoForTests = \Mockery::mock(\stdClass::class, ProductRepositoryInterface::class);
        $this->repoForTests->shouldReceive('findById')->once()->andReturn($this->mockEntity);
        $this->repoForTests->shouldReceive('update')->once()->andReturn($this->mockEntityUpdated);

        $this->mockInputDto = \Mockery::mock(UpdateProductInputDto::class, [
            $id,
            "GeForce RTX 3060 TI",
        ]);

        $useCase = new UpdateProductUseCase($this->repoForTests);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(UpdateProductOutputDto::class, $response);
        $this->assertNotEquals($this->mockEntity->name, $response->name);
    }

    protected function tearDown(): void {
        \Mockery::close();
        parent::tearDown();
    }
}