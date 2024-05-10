<?php declare(strict_types=1);

namespace TddExercises\Multiples\Condition;

use TddExercises\Multiples\Rule\MultipleOfFiveteen;

final class Fiveteen
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
    $fiveteen = new MultipleOfFiveteen();

    return $fiveteen->handle($value);
  }
}
