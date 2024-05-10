<?php declare(strict_types=1);

namespace TddExercises\Multiples\Rule;

use TddExercises\Multiples\Chain;

final class MultipleOfFiveteen extends Chain
{
  public function handle($value): bool
  {
    if ($this->validate($value)) {
      return true;
    }

    return parent::handle($value);
  }

  private function validate($value): bool
  {
    if(is_numeric($value) and is_integer($value) and $value <= 0) {
      return false;
    }

    return $value % 15 === 0;
  }
}
