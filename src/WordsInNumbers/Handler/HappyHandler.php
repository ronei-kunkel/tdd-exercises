<?php declare(strict_types=1);

namespace TddExercises\WordsInNumbers\Handler;

use TddExercises\Happy\HappyChecker;
use TddExercises\IntChecker;
use TddExercises\Multiples\Handler;
use TddExercises\Valuable;
use TddExercises\WordsInNumbers\Happy;
use TddExercises\WordsInNumbers\Word;

final class HappyHandler extends Handler
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

    if($input instanceof Happy) {
      $result = $this->checker->check($value);

      if($result) {
        $input->defineAsHappy();
      }
    }

    if($this->next) {
      return $this->next->handle($input);
    }

    return true;
  }
}
