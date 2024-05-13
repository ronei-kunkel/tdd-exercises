<?php declare(strict_types=1);

namespace TddExercises\Multiples;

abstract class Handler
{
  protected ?Handler $next = null;

  abstract public function handle(mixed $input): bool;

  public function setNext(Handler $next): Handler
  {
    $this->next = $next;
    return $next;
  }
}
