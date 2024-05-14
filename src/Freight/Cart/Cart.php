<?php declare(strict_types=1);

namespace TddExercises\Freight\Cart;

use TddExercises\Freight\Product as SystemProduct;
use TddExercises\Freight\Cart\Product as CartProduct;
use TddExercises\Freight\ProductBag;
use TddExercises\Freight\User;

class Cart
{
  private ProductList $productList;

  public function __construct(
    private User $user
  ) {
    $this->resetList();
  }

  public function clean(): void
  {
    $this->resetList();
  }

  private function resetList(): void
  {
    $this->productList = new ProductList();
  }

  public function isEmpty(): bool
  {
    return ($this->productList->count() === 0);
  }

  public function addProduct(SystemProduct $systemProduct, int $units): self
  {
    $cartProduct = new CartProduct($systemProduct, $units);

    $this->productList->add($cartProduct);

    return $this;
  }

  public function addProducts(ProductBag $products): void
  {
    foreach ($products->products() as $cartProduct) {
      $this->productList->add($cartProduct);
    }
  }

  public function removeItemOf(SystemProduct $systemProduct, int $units = 1): bool
  {
    $cartProduct = new CartProduct($systemProduct, $units);

    return $this->productList->removeUnitsOf($cartProduct);
  }

  public function removeProduct(SystemProduct $systemProduct): bool
  {
    $cartProduct = $this->productList->getCartProduct($systemProduct);

    if (!$cartProduct) {
      return false;
    }

    $this->productList->remove($cartProduct);
    return true;
  }

  public function getAmount(): int
  {
    $amount = 0;
    foreach ($this->productList->products() as $product) {
      $amount += $product->value() * $product->units();
    }

    return $amount;
  }

  public function getTotalItemCount(): int
  {
    $units = 0;
    foreach ($this->productList->products() as $product) {
      $units += $product->units();
    }

    return $units;
  }

  public function getTotalProductCount(): int
  {
    return $this->productList->count();
  }

  public function getDeliveryCep(): string
  {
    return $this->user->cep();
  }

  public function getDeliveryName(): string
  {
    return $this->user->name();
  }
}
