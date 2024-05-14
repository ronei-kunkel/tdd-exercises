<?php declare(strict_types=1);

namespace Tests\Unit\Freight;

use TddExercises\Freight\Cart\Cart;
use TddExercises\Freight\ProductBag;
use TddExercises\Freight\Product;
use TddExercises\Freight\User;
use Tests\TestCase;

class CartTest extends TestCase
{
  public function test_should_create_empty_cart(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $cart = new Cart($userMock);

    $this->assertEquals(0, $cart->getAmount());
    $this->assertEquals(0, $cart->getTotalItemCount());
    $this->assertEquals(0, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_should_add_product_on_cart(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 3;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);

    $this->assertEquals(3450, $cart->getAmount());
    $this->assertEquals(3, $cart->getTotalItemCount());
    $this->assertEquals(1, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_should_add__repeated_product_on_cart_result_in_increase_of_units_only(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 3;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);
    $cart->addProduct($productMock1, 1);

    $this->assertEquals(4600, $cart->getAmount());
    $this->assertEquals(4, $cart->getTotalItemCount());
    $this->assertEquals(1, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_should_add_multiple_products_on_cart_with_bag(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 3;

    $productMock2 = $this->createMock(Product::class);
    $productMock2->method('name')->willReturn('Product Test 2');
    $productMock2->method('value')->willReturn(1599); // R$15,99

    $productMock2Units = 1;

    $cart = new Cart($userMock);

    $productBag = new ProductBag();
    $productBag->addProduct($productMock1, $productMock1Units)->addProduct($productMock2, $productMock2Units);

    $cart->addProducts($productBag);

    $this->assertEquals(5049, $cart->getAmount());
    $this->assertEquals(4, $cart->getTotalItemCount());
    $this->assertEquals(2, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_should_remove_product_item(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 4;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);

    $cart->removeItemOf($productMock1);

    $cart->removeItemOf($productMock1, 2);

    $this->assertEquals(1150, $cart->getAmount());
    $this->assertEquals(1, $cart->getTotalItemCount());
    $this->assertEquals(1, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_when_remove_all_items_of_product_result_in_exclusion_of_product_from_cart(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 4;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);

    $cart->removeItemOf($productMock1, 4);

    $this->assertEquals(0, $cart->getAmount());
    $this->assertEquals(0, $cart->getTotalItemCount());
    $this->assertEquals(0, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_return_false_when_try_remove_more_units_of_product_in_cart(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 4;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);

    $unitsRemoved = $cart->removeItemOf($productMock1, 5);

    $this->assertFalse($unitsRemoved);
    $this->assertEquals(4600, $cart->getAmount());
    $this->assertEquals(4, $cart->getTotalItemCount());
    $this->assertEquals(1, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_return_true_when_try_remove_units_of_product_in_cart(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 4;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);

    $unitsRemoved = $cart->removeItemOf($productMock1, 1);

    $this->assertTrue($unitsRemoved);
    $this->assertEquals(3450, $cart->getAmount());
    $this->assertEquals(3, $cart->getTotalItemCount());
    $this->assertEquals(1, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_should_remove_product(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 4;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);

    $productRemoved = $cart->removeProduct($productMock1);

    $this->assertTrue($productRemoved);
    $this->assertEquals(0, $cart->getAmount());
    $this->assertEquals(0, $cart->getTotalItemCount());
    $this->assertEquals(0, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_should_return_false_when_try_remove_product_thats_not_in_cart(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock2 = $this->createMock(Product::class);

    $productMock1Units = 4;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);

    $productRemoved = $cart->removeProduct($productMock2);

    $this->assertFalse($productRemoved);
    $this->assertEquals(4600, $cart->getAmount());
    $this->assertEquals(4, $cart->getTotalItemCount());
    $this->assertEquals(1, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }

  public function test_should_clean_cart(): void
  {
    $userMock = $this->createMock(User::class);
    $userMock->method('name')->willReturn('Test User');
    $userMock->method('cep')->willReturn('99999000');

    $productMock1 = $this->createMock(Product::class);
    $productMock1->method('name')->willReturn('Product Test 1');
    $productMock1->method('value')->willReturn(1150); // R$11,50

    $productMock1Units = 4;

    $cart = new Cart($userMock);

    $cart->addProduct($productMock1, $productMock1Units);

    $cart->clean();

    $this->assertEquals(0, $cart->getAmount());
    $this->assertEquals(0, $cart->getTotalItemCount());
    $this->assertEquals(0, $cart->getTotalProductCount());
    $this->assertEquals('99999000', $cart->getDeliveryCep());
    $this->assertEquals('Test User', $cart->getDeliveryName());
  }
}
