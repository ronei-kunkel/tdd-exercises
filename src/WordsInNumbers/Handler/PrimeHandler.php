<?php declare(strict_types=1);

namespace TddExercises\WordsInNumbers\Handler;

use TddExercises\Happy\HappyChecker;
use TddExercises\IntChecker;
use TddExercises\Multiples\Handler;
use TddExercises\Valuable;
use TddExercises\WordsInNumbers\Happy;
use TddExercises\WordsInNumbers\Prime;
use TddExercises\WordsInNumbers\Word;

final class PrimeHandler extends Handler
{

  public function __construct(
    private Valuable $valuable,
    private IntChecker $checker
  ){
  }

  /**
   * @param Word $input
   */
  public function handle(mixed $input): bool
  {
    if(!$input instanceof Word) {
      return false;
    }

    $value = $this->valuable->valueOf($input->getContent());

    if($input instanceof Prime) {
      $result = $this->checker->check($value);

      if($result) {
        $input->defineAsPrime();
      }
    }

    if($this->next) {
      return $this->next->handle($input);
    }

    return true;
  }
}
