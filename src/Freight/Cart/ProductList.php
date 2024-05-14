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
    $this->addUnitsIn($cartProduct);
  }

  public function count(): int
  {
    return count($this->list);
  }

  public function has(CartProduct $cartProduct): bool
  {
    return in_array($cartProduct, $this->list);
  }

  public function addUnitsIn(CartProduct $cartProduct): void
  {
    if(!$this->has($cartProduct)) {
      $this->list[] = $cartProduct;
      return;
    }

    foreach($this->list as $key => $product) {
      if($product->getSystemProduct() === $cartProduct->getSystemProduct()) {
        $newUnits = $product->units() + $cartProduct->units();
        $this->list[$key] = new CartProduct($product->getSystemProduct(), $newUnits);
      }
    }
  }

  public function canRemoveUnitsOf(CartProduct $cartProduct): bool
  {
    foreach($this->list as $key => $product) {
      if($product->getSystemProduct() === $cartProduct->getSystemProduct()) {
        return $product->units() >= $cartProduct->units();
      }
    }

    return false;
  }

  public function removeUnitsOf(CartProduct $cartProduct): bool
  {
    foreach($this->list as $key => $product) {
      if($product->getSystemProduct() === $cartProduct->getSystemProduct()) {
        $newUnits = $product->units() - $cartProduct->units();

        if($newUnits < 0) {
          return false;
        }

        if($newUnits === 0) {
          unset($this->list[$key]);
          return true;
        }

        $this->list[$key] = new CartProduct($product->getSystemProduct(), $newUnits);
        return true;
      }
    }

    return false;
  }

  public function getCartProduct(SystemProduct $systemProduct): ?CartProduct
  {
    foreach($this->list as $key => $product) {
      if($product->getSystemProduct() === $systemProduct) {
        return $this->list[$key];
      }
    }

    return null;
  }

  public function remove(CartProduct $cartProduct): bool
  {
    foreach($this->list as $key => $product) {
      if($product->getSystemProduct() === $cartProduct->getSystemProduct()) {
        unset($this->list[$key]);
        return true;
      }
    }

    return false;
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
