<?php

use Core\Domain\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
    public function test_CreateProductWithAttributes() {
        $product = new Product(
            name: "GeForce RTX 3060",
            price: 449.99,
            onStock: true
        );

        $this->assertEquals("GeForce RTX 3060", $product->name);
        $this->assertEquals(449.99, $product->price);
        $this->assertTrue($product->onStock);
    }

    public function test_RemoveProductFromStock() {
        $product = new Product(
            name: "GeForce RTX 3060",
            price: 449.99,
            onStock: true
        );

        $product->removeFromStock();
        $this->assertFalse($product->onStock);
    }

    public function test_AddProductOnStock() {
        $product = new Product(
            name: "GeForce RTX 3060",
            price: 449.99,
            onStock: false
        );

        $product->addOnStock();
        $this->assertTrue($product->onStock);
    }

    public function test_UpdateProduct() {
        $uuid = 'uuid.value';
        $product = new Product(
            name: "GeForce RTX 3060",
            price: 449.99,
            id: $uuid,
            onStock: true
        );

        $product->update(
            name: "GeForce RTX 3060 TI",
            price: 599.99,
        );

        $this->assertEquals("GeForce RTX 3060 TI", $product->name);
        $this->assertEquals(599.99, $product->price);
    }

    public function test_UpdateProductWithoutPrice() {
        $uuid = 'uuid.value';
        $product = new Product(
            name: "GeForce RTX 3060",
            price: 449.99,
            id: $uuid,
            onStock: true
        );

        $product->update(
            name: "GeForce RTX 3060 TI",
        );

        $this->assertEquals("GeForce RTX 3060 TI", $product->name);
        $this->assertEquals(449.99, $product->price);
    }
}