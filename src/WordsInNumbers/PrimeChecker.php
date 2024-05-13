<?php declare(strict_types=1);

namespace TddExercises\WordsInNumbers;

use TddExercises\IntChecker;

final class PrimeChecker implements IntChecker
{
  public function check(int $number): bool
  {
    return $this->calculate($number);
  }

  private function calculate(int $number): bool
  {
    $multiples = 0;

    for ($i = 1; $i <= $number; $i++){
      if($number % $i === 0) {
        $multiples++;
      }
    }

    return ($multiples == 2);
  }
}
