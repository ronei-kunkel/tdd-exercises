<?php declare(strict_types=1);

namespace Tests\Unit\Freight;

use TddExercises\Freight\Product;
use TddExercises\Freight\Cart\Product as CartProduct;
use TddExercises\Freight\ProductBag;
use Tests\TestCase;

class ProductBagTest extends TestCase
{
  public function test_should_can_add_products(): void
  {
    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 3;

    $productMock2 = $this->createMock(Product::class);
    $productMock2->method('name')->willReturn('Product Test 2');
    $productMock2->method('value')->willReturn(1050); // R$11,50

    $productMock2Units = 2;

    $bag = new ProductBag();

    $bag->addProduct($productMock1, $productMock1Units)->addProduct($productMock2, $productMock2Units);

    $instanceOfCartProduct1IsCorrect = false;
    $nameOfCartProduct1IsCorrect = false;
    $valueOfCartProduct1IsCorrect = false;
    $unitsOfCartProduct1IsCorrect = false;

    $instanceOfCartProduct2IsCorrect = false;
    $nameOfCartProduct2IsCorrect = false;
    $valueOfCartProduct2IsCorrect = false;
    $unitsOfCartProduct2IsCorrect = false;

    // CartProduct are different of Product and have the ->units() method
    foreach ($bag->products() as $product) {
      if($product->name() === 'Product Test 1' and $product->value() === 1150 and $product->units() === 3) {
        if($product instanceof CartProduct) {
          $instanceOfCartProduct1IsCorrect = true;
        }
        $nameOfCartProduct1IsCorrect = true;
        $valueOfCartProduct1IsCorrect = true;
        $unitsOfCartProduct1IsCorrect = true;
      }

      if($product->name() === 'Product Test 2' and $product->value() == 1050 and $product->units() === 2) {
        if($product instanceof CartProduct) {
          $instanceOfCartProduct2IsCorrect = true;
        }
        $nameOfCartProduct2IsCorrect = true;
        $valueOfCartProduct2IsCorrect = true;
        $unitsOfCartProduct2IsCorrect = true;
      }
    };

    $this->assertTrue($instanceOfCartProduct1IsCorrect);
    $this->assertTrue($nameOfCartProduct1IsCorrect);
    $this->assertTrue($valueOfCartProduct1IsCorrect);
    $this->assertTrue($unitsOfCartProduct1IsCorrect);

    $this->assertTrue($instanceOfCartProduct2IsCorrect);
    $this->assertTrue($nameOfCartProduct2IsCorrect);
    $this->assertTrue($valueOfCartProduct2IsCorrect);
    $this->assertTrue($unitsOfCartProduct2IsCorrect);
  }
}
