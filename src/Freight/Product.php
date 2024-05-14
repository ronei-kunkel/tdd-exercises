<?php declare(strict_types=1);

namespace TddExercises\Freight;

class Product
{
  public function __construct(
    protected string $name,
    protected int $value
  ) {
    if($value < 0) {
      throw new \DomainException("Invalid product value. It must be greather or equals to 0");
    }
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
