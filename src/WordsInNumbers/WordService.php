<?php declare(strict_types=1);

namespace TddExercises\WordsInNumbers;

use TddExercises\Happy\HappyChecker;
use TddExercises\Multiples\Handler\MultipleOf3Or5Handler;
use TddExercises\Valuable;
use TddExercises\WordsInNumbers\Handler\DivisibleBy3Or5Handler;
use TddExercises\WordsInNumbers\Handler\HappyHandler;
use TddExercises\WordsInNumbers\Handler\PrimeHandler;
use TddExercises\WordsInNumbers\PrimeChecker;
use TddExercises\WordsInNumbers\Word;

final class WordService
{
  public function __construct(
    private Valuable $valuable
  ) {
  }

  public function analyse(Word $word): void
  {
    $happyChecker = new HappyChecker();
    $happyHandler = new HappyHandler($this->valuable, $happyChecker);

    $multipleOf3Or5 = new MultipleOf3Or5Handler();
    $divisibleBy3Or5Handler = new DivisibleBy3Or5Handler($this->valuable, $multipleOf3Or5);

    $primeChecker = new PrimeChecker();
    $primeHandler = new PrimeHandler($this->valuable, $primeChecker);

    $happyHandler->setNext($divisibleBy3Or5Handler)->setNext($primeHandler);

    $happyHandler->handle($word);
  }
}
