<?php declare(strict_types=1);

namespace Tests\Unit\Freight;

use TddExercises\Freight\Cart\Product as CartProduct;
use TddExercises\Freight\Product;
use Tests\TestCase;

class CartProductTest extends TestCase
{

  public function test_create_valid_cart_product(): void
  {
    $systemProduct = new Product('Test Product', 1199);
    $product = new CartProduct($systemProduct, 1);

    $this->assertEquals('Test Product', $product->name());
    $this->assertEquals(1199, $product->value());
    $this->assertEquals(1, $product->units());
  }
}