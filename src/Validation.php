<?php declare(strict_types=1);

namespace TddExercises;

abstract class Validation
{
  protected abstract function validate(mixed $input): bool;
}
