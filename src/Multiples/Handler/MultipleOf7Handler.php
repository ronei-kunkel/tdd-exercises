<?php declare(strict_types=1);

namespace TddExercises\Multiples\Handler;

use TddExercises\Multiples\Handler;
use TddExercises\Multiples\MultipleOf;

final class MultipleOf7Handler extends Handler
{

  public function handle(mixed $input): bool
  {
    if (!is_numeric($input)) {
      return false;
    }

    if (!is_int($input)) {
      $input = (int) $input;
    }

    $multipleOf = new MultipleOf(7);

    $multiple = $multipleOf->check($input);

    if (!$multiple) {
      return false;
    }

    if (!$this->next) {
      return $multiple;
    }

    return $this->next->handle($input);
  }
}
