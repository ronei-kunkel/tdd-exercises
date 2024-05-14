<?php declare(strict_types=1);

namespace Tests\Unit\Freight;

use TddExercises\Freight\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
  public function test_create_valid_product(): void
  {
    $product = new Product('Test Product', 1199);

    $this->assertEquals('Test Product', $product->name());
    $this->assertEquals(1199, $product->value());
  }
}