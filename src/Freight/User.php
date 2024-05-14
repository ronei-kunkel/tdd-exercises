<?php declare(strict_types=1);

namespace TddExercises\Freight;

class User
{
  public function __construct(
    private string $name,
    private string $cep
  ) {
    if(strlen($cep) !== 8 or !is_numeric($cep)) {
      throw new \DomainException('Invalid value for user cep. Value must be composite by 8 numeric digits');
    }
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
