<?php declare(strict_types=1);

namespace TddExercises\Freight;

final class User
{
  public function __construct(
    private string $name,
    private string $cep
  ) {
  }

  public function name(): string
  {
    return $this->name;
  }

  public function cep(): string
  {
    return $this->cep;
  }
}
