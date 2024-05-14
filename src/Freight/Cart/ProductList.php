<?php declare(strict_types=1);

namespace TddExercises\Freight\Cart;

use TddExercises\Freight\Cart\Product as CartProduct;
use TddExercises\Freight\Product as SystemProduct;

class ProductList
{
  /**
   * @var CartProduct[]
   */
  private $list;

  public function __construct()
  {
    $this->list = [];
  }

  public function add(CartProduct $cartProduct): void
  {
    if(!$this->has($cartProduct)) {
      $this->list[] = $cartProduct;
      return;
    }

    $this->addUnitsIn($cartProduct);
  }

  public function count(): int
  {
    return count($this->list);
  }

  public function has(CartProduct $cartProduct): bool
  {
    $keyOfCartProduct = $this->getKeyOfCartProduct($cartProduct);

    if($keyOfCartProduct === null) {
      return false;
    }

    return true;
  }

  public function addUnitsIn(CartProduct $cartProduct): void
  {
    if(!$this->has($cartProduct)) {
      return;
    }

    $keyProduct = $this->getKeyOfCartProduct($cartProduct);

    $product = $this->list[$keyProduct];

    $updatedUnits = $product->units() + $cartProduct->units();

    $updatedProduct = new CartProduct(new SystemProduct($cartProduct->name(), $cartProduct->value()), $updatedUnits);

    $this->list[$keyProduct] = $updatedProduct;
  }

  private function getKeyOfCartProduct(CartProduct $cartProduct): ?int
  {
    $keyProduct = null;
    foreach($this->list as $key => $product) {
      if($product->name() === $cartProduct->name() && $product->value() === $cartProduct->value()) {
        $keyProduct = $key;
      }
    }

    return $keyProduct;
  }

  private function getKeyOfSystemProduct(SystemProduct $systemProduct): ?int
  {
    $keyProduct = null;
    foreach($this->list as $key => $product) {
      if($product->name() === $systemProduct->name() && $product->value() === $systemProduct->value()) {
        $keyProduct = $key;
      }
    }

    return $keyProduct;
  }

  public function removeUnitsOf(CartProduct $cartProduct): bool
  {
    if(!$this->has($cartProduct)) {
      return false;
    }

    $keyProduct = $this->getKeyOfCartProduct($cartProduct);

    $product = $this->list[$keyProduct];

    if($cartProduct->units() > $product->units()) {
      return false;
    }

    $updatedUnits = $product->units() - $cartProduct->units();

    if($updatedUnits === 0) {
      unset($this->list[$keyProduct]);
      return true;
    }

    $updatedProduct = new CartProduct(new SystemProduct($cartProduct->name(), $cartProduct->value()), $updatedUnits);

    $this->list[$keyProduct] = $updatedProduct;
    return true;
  }

  public function getCartProduct(SystemProduct $systemProduct): ?CartProduct
  {
    $cartProductKey = $this->getKeyOfSystemProduct($systemProduct);

    if($cartProductKey === null) {
      return null;
    }

    return $this->list[$cartProductKey];
  }

  public function remove(CartProduct $cartProduct): bool
  {
    $keyProduct = $this->getKeyOfCartProduct($cartProduct);

    if($keyProduct === null) {
      return false;
    }

    unset($this->list[$keyProduct]);

    return true;
  }

  /**
   * @return CartProduct[]
   */
  public function products(): array
  {
    $clonedCartProducts = [];

    foreach ($this->list as $cartProduct) {
      $clonedCartProducts[] = clone $cartProduct;
    }

    return $clonedCartProducts;
  }
}
