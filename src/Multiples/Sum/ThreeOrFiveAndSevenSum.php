<?php declare(strict_types=1);

namespace TddExercises\Multiples\Sum;

use TddExercises\Multiples\Handler\MultipleOf3Or5Handler;
use TddExercises\Multiples\Handler\MultipleOf7Handler;

final class ThreeOrFiveAndSevenSum
{
  private int $result = 0;

  public function __construct(
    private int $value
  ) {
    if ($value < 0) {
      throw new \InvalidArgumentException("The number for the sum has to be natural.");
    }
  }

  public function sum(): int
  {
    $this->calculateSum();
    return $this->result;
  }

  private function calculateSum(): void
  {
    for ($i = 0; $i < $this->value; $i++) {
      if ($this->satisfyConditions($i)) {
        $this->result += $i;
      }
    }
  }

  private function satisfyConditions(int $value): bool
  {
    $threeOrFive = new MultipleOf3Or5Handler();
    $seven = new MultipleOf7Handler();
    $threeOrFive->setNext($seven);

    return $threeOrFive->handle($value);
  }
}
