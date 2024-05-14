<?php declare(strict_types=1);

namespace TddExercises\Freight\Cart;

use TddExercises\Freight\Product as SystemProduct;

class Product extends SystemProduct
{
  public function __construct(
    private SystemProduct $product,
    private int $units
  ) {
    if($units <= 0) {
      throw new \DomainException("Invalid value for product units. It must be greather than 0");
    }

    parent::__construct($product->name(), $product->value());
  }

  public function units(): int
  {
    return $this->units;
  }

  public function getSystemProduct(): SystemProduct
  {
    return $this->product;
  }
}
