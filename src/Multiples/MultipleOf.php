<?php declare(strict_types=1);

namespace TddExercises\Multiples;
use TddExercises\IntChecker;

final class MultipleOf implements IntChecker
{
  public function __construct(
    private int $multiple
  ){
  }

  public function check(int $number): bool
  {
    return $number % $this->multiple === 0;
  }
}
