<?php declare(strict_types=1);

namespace TddExercises\WordsInNumbers;

use TddExercises\Validation;
use TddExercises\Valuable;

final class SimpleAlphabetCharService extends Validation implements Valuable
{
  public function valueOf(mixed $char): int
  {
    if(!$this->validate($char)) {
      return 0;
    }

    return $this->calculatedValue($char);
  }

  protected function validate(mixed $char): bool
  {
    return match (true) {
      strlen($char) === 1 and preg_match("/[a-zA-Z]/", $char) => true,
      default => false,
    };
  }

  private function calculatedValue(string $char): int
  {
    $result = 0;

    $result = ord(strtolower($char)) - ord('a') + 1;

    if(ctype_upper($char)) {
      return $result + ord('z') - ord('a') + 1;
    }

    return $result;
  }
}
