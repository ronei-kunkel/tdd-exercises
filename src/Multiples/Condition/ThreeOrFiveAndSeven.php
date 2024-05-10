<?php declare(strict_types=1);

namespace TddExercises\Multiples\Condition;

use TddExercises\Multiples\Rule\MultipleOfFive;
use TddExercises\Multiples\Rule\MultipleOfSeven;
use TddExercises\Multiples\Rule\MultipleOfThree;

final class ThreeOrFiveAndSeven
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
    $three = new MultipleOfThree();
    $five = new MultipleOfFive();
    $three->next($five);

    $seven = new MultipleOfSeven();

    return ($three->handle($value) and $seven->handle($value));
  }
}
