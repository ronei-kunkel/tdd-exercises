<?php declare(strict_types=1);

namespace TddExercises\WordsInNumbers\Handler;

use TddExercises\Multiples\Handler;
use TddExercises\Valuable;
use TddExercises\WordsInNumbers\Contentable;
use TddExercises\WordsInNumbers\DivisibleBy3Or5;
use TddExercises\WordsInNumbers\Word;

final class DivisibleBy3Or5Handler extends Handler
{

  public function __construct(
    private Valuable $valuable,
    private Handler $handler
  ){
  }

  /**
   * @param Word $input
   */
  public function handle(mixed $input): bool
  {
    if(! $input instanceof Contentable) {
      return false;
    }

    $value = $this->valuable->valueOf($input->getContent());

    if($input instanceof DivisibleBy3Or5) {
      $result = $this->handler->handle($value);

      if($result) {
        $input->defineAsDivisibleBy3Or5();
      }
    }

    if($this->next) {
      return $this->next->handle($input);
    }

    return true;
  }
}
