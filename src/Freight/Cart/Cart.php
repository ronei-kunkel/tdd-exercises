<?php declare(strict_types=1);

namespace TddExercises\Freight\Cart;

use TddExercises\Freight\User;

final class Cart
{
  public function __construct(
    private User $user
  ) {
  }
}
