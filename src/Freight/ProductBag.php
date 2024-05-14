<?php declare(strict_types=1);

namespace TddExercises\Freight;

use TddExercises\Freight\Cart\Product as CartProduct;
use TddExercises\Freight\Product as SystemProduct;

class ProductBag
{
  private \SplQueue $productList;
  public function __construct()
  {
    $this->productList = new \SplQueue();
  }

  public function addProduct(SystemProduct $product, int $units): self
  {
    if($units <= 0) {
      throw new \DomainException("Invalid value for product units. It must be greather than 0");
    }

    $cartProduct = new CartProduct($product, $units);
    $this->productList->enqueue($cartProduct);
    return $this;
  }

  /**
   * @return CartProduct[]
   */
  public function products(): \Iterator
  {
    $copiedQueue = new \SplQueue();

    foreach ($this->productList as $product) {
      $copiedQueue->enqueue(clone $product);
    }

    return $copiedQueue;
  }
}
