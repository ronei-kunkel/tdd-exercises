<?php declare(strict_types=1);

namespace Tests\Unit\Freight;

use TddExercises\Freight\Cart\Product as CartProduct;
use TddExercises\Freight\Cart\ProductList;
use TddExercises\Freight\Product as SystemProduct;
use Tests\TestCase;

class ProductListTest extends TestCase
{

  public function test_can_add_diferent_products(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $cartProduct2 = new CartProduct(new SystemProduct('Product Test 2', 9998), 1);

    $productList = new ProductList();

    $productList->add($cartProduct1);
    $productList->add($cartProduct2);

    $this->assertEquals(2, $productList->count());
  }

  public function test_can_increase_units_of_product_when_add_already_exists(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $productList = new ProductList();

    $productList->add($cartProduct1);
    $productList->add($cartProduct1);

    $unitsOfProduct = 0;

    $this->assertEquals(1, $productList->count());

    foreach ($productList->products() as $product) {
      $unitsOfProduct += $product->units();
    }

    $this->assertEquals(6, $unitsOfProduct);
  }

  public function test_should_verify_if_has_product(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $productList = new ProductList();

    $productList->add($cartProduct1);

    $this->assertTrue($productList->has($cartProduct1));
  }

  public function test_create_product_when_add_units_of_unlisted_product(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $productList = new ProductList();

    $productList->addUnitsIn($cartProduct1);

    $this->assertTrue($productList->has($cartProduct1));
  }

  public function test_remove_products(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $cartProduct2 = new CartProduct(new SystemProduct('Product Test 2', 9998), 1);

    $productList = new ProductList();

    $productList->add($cartProduct1);
    $productList->add($cartProduct2);

    $this->assertEquals(2, $productList->count());

    $productList->remove($cartProduct2);

    $this->assertEquals(1, $productList->count());
  }

  public function test_remove_unit_of_product(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $cartProductToRemoveUnits = new CartProduct(new SystemProduct('Product Test 1', 9999), 1);

    $productList = new ProductList();

    $productList->add($cartProduct1);

    $this->assertEquals(3, $productList->products()[0]->units());

    $productList->removeUnitsOf($cartProductToRemoveUnits);

    $this->assertEquals(2, $productList->products()[0]->units());
  }

  public function test_remove_product_when_remove_all_units_of_product(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $cartProductToRemoveUnits = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $productList = new ProductList();

    $productList->add($cartProduct1);

    $this->assertEquals(3, $productList->products()[0]->units());

    $productList->removeUnitsOf($cartProductToRemoveUnits);

    $this->assertEquals(0, $productList->count());
  }

  public function test_get_cart_product_from_system_product(): void
  {
    $systemProduct = new SystemProduct('Product Test 1', 9999);

    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $productList = new ProductList();

    $productList->add($cartProduct1);

    $retrieveSystemProduct = $productList->getCartProduct($systemProduct);

    $this->assertEquals($retrieveSystemProduct, $systemProduct);
  }

  public function test_return_quantity_of_products(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $cartProduct2 = new CartProduct(new SystemProduct('Product Test 2', 9998), 1);

    $productList = new ProductList();
    
    $this->assertEquals(0, $productList->count());

    $productList->add($cartProduct1);
    $productList->add($cartProduct2);

    $this->assertEquals(2, $productList->count());
  }

  public function test_should_be_return_list_of_cloned_cart_objects(): void
  {
    $cartProduct1 = new CartProduct(new SystemProduct('Product Test 1', 9999), 3);

    $cartProduct2 = new CartProduct(new SystemProduct('Product Test 2', 9998), 1);

    $cartProduct3 = new CartProduct(new SystemProduct('Product Test 3', 9997), 1);

    $productList = new ProductList();

    $productList->add($cartProduct1);
    $productList->add($cartProduct2);

    $productList->products()[] = $cartProduct3;

    $this->assertEquals(2, $productList->count());
  }
}
