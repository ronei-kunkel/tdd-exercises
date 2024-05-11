<?php declare(strict_types=1);

namespace TddExercises;

interface Valuable
{
  public function valueOf(mixed $input): int;
}
