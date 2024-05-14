<?php declare(strict_types=1);

namespace TddExercises\Freight\Cart;

use TddExercises\Freight\Product as SystemProduct;

final class Product extends SystemProduct
{
  public function __construct(
    private SystemProduct $product,
    private int $units
  ) {
    parent::__construct($product->name(), $product->value());
  }

  public function units(): int
  {
    return $this->units;
  }
}
