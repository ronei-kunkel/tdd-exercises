<?php declare(strict_types=1);

namespace TddExercises;

abstract class Validation
{
  abstract protected function validate(mixed $input): bool;
}
