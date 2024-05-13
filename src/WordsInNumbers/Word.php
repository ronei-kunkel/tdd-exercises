<?php declare(strict_types=1);

namespace TddExercises\WordsInNumbers;

final class Word implements Happy, DivisibleBy3Or5, Prime
{
  private bool $prime = false;
  private bool $happy = false;
  private bool $divisibleBy3Or5 = false;

  public function __construct(
    private string $value
  ){
  }

  public function getContent(): string
  {
    return $this->value;
  }

  public function defineAsPrime(): void
  {
    $this->prime = true;
  }

  public function defineAsDivisibleBy3Or5(): void
  {
    $this->divisibleBy3Or5 = true;
  }

  public function defineAsHappy(): void
  {
    $this->happy = true;
  }

  public function isHappy(): bool
  {
    return $this->happy;
  }

  public function isDivisibleBy3Or5(): bool
  {
    return $this->divisibleBy3Or5;
  }

  public function isPrime(): bool
  {
    return $this->prime;
  }
}
