<?php

use Core\Domain\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
    public function testProductAttributes() {
        $product = new Product(
            name: "GeForce RTX 3060",
            price: 449.99,
            onStock: true
        );

        $this->assertEquals("GeForce RTX 3060", $product->name);
        $this->assertEquals(449.99, $product->price);
        $this->assertTrue($product->onStock);
    }
}