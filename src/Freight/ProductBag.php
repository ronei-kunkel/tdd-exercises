<?php declare(strict_types=1);

namespace TddExercises\Freight;

use TddExercises\Freight\Cart\Product as CartProduct;
use TddExercises\Freight\Product as SystemProduct;

class ProductBag
{
  /**
   * @var CartProduct[]
   */
  private array $productList;
  public function __construct()
  {
    $this->productList = [];
  }

  public function addProduct(SystemProduct $product, int $units): self
  {
    if($units <= 0) {
      throw new \DomainException("Invalid value for product units. It must be greather than 0");
    }

    $cartProduct = new CartProduct($product, $units);
    $this->productList[] = $cartProduct;
    return $this;
  }

  /**
   * @return CartProduct[]
   */
  public function products(): array
  {
    $copiedQueue = [];

    foreach ($this->productList as $product) {
      $copiedQueue[] = clone $product;
    }

    return $copiedQueue;
  }
}
