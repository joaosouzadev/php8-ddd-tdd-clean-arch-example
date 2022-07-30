<?php

namespace Tests\Unit\UseCase\Product;

use Core\Domain\Entity\Product;
use Core\Domain\Repository\ProductRepositoryInterface;
use Core\UseCase\DTO\Product\DeleteProductOutputDto;
use Core\UseCase\DTO\Product\ProductInputDto;
use Core\UseCase\Product\DeleteProductUseCase;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class DeleteProductUseCaseTest extends TestCase {
    public function test_deleteProduct() {
        $id = Uuid::uuid4()->toString();
        $this->mockEntity = \Mockery::mock(Product::class, [
            "GeForce RTX 3060",
            499.99,
            $id,
        ]);

        $this->repoForTests = \Mockery::mock(\stdClass::class, ProductRepositoryInterface::class);
        $this->repoForTests->shouldReceive('delete')->once()->andReturn(true);

        $this->mockInputDto = \Mockery::mock(ProductInputDto::class, [
            $id,
        ]);

        $useCase = new DeleteProductUseCase($this->repoForTests);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(DeleteProductOutputDto::class, $response);
        $this->assertTrue($response->success);
    }

    protected function tearDown(): void {
        \Mockery::close();
        parent::tearDown();
    }
}