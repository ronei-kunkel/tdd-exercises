<?php declare(strict_types=1);

namespace TddExercises\Multiples;

abstract class Chain
{
  protected ?Chain $next = null;

  public function next(Chain $next) {
    $this->next = $next;
  }

  public function handle($value): bool
  {
    if (!$this->hasNext()) {
      return false;
    }

    return $this->next->handle($value);
  }

  private function hasNext(): bool
  {
    return (!is_null($this->next));
  }
}
