<?php declare(strict_types=1);

namespace TddExercises\Multiples\Handler;

use TddExercises\Multiples\Handler;
use TddExercises\Multiples\MultipleOf;

final class MultipleOf3Or5Handler extends Handler
{

  public function handle(mixed $input): bool
  {
    if (!is_numeric($input)) {
      return false;
    }

    if (!is_int($input)) {
      $input = (int) $input;
    }

    $multipleOf3 = new MultipleOf(3);

    $multiple3 = $multipleOf3->check($input);

    $multipleOf5 = new MultipleOf(5);

    $multiple5 = $multipleOf5->check($input);

    $multiple = ($multiple3 or $multiple5);

    if (!$multiple) {
      return false;
    }

    if (!$this->next) {
      return $multiple;
    }

    return $this->next->handle($input);
  }
}
