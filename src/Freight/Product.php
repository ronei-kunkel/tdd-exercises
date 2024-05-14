<?php declare(strict_types=1);

namespace TddExercises\Freight;

class Product
{
  public function __construct(
    protected string $name,
    protected int $value
  ) {
  }

  public function name(): string
  {
    return $this->name;
  }

  public function value(): int
  {
    return $this->value;
  }
}
