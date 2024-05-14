<?php declare(strict_types=1);

namespace TddExercises\Freight;

use TddExercises\Freight\Cart\Cart;

class FreightCalculator
{
  public function __construct(
    private FreightFeeApi $freightFeeApi
  ) {
  }

  public function calculateAmount(Cart $cart): int
  {
    if($cart->isEmpty()) {
      throw new \Exception('Cannot calculate empty cart. Add products to cart to be able to calculate fee');
    }

    $cartAmount = $cart->getAmount();

    $fee = 0;

    if ($cartAmount < 10000) {
      $fee = $this->freightFeeApi->quoteFor($cart->getDeliveryCep());
    }

    return $cartAmount + $fee;
  }
}
