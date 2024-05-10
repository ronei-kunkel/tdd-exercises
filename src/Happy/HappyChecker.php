<?php declare(strict_types=1);

namespace TddExercises\Happy;

/**
 * Transformar em NumberVerify para ser aberto para extensão (talvez implementar facade para isso)
 * 
 * implementar uma interface de verificação
 * 
 * HappyNumber implements NumberVerify
 * 
 * HappyNumber->verify(int $number)
 */
final class HappyChecker
{

  /**
   * @var string[]
   */
  private array $digits = [];

  private string $currentNumber = '';

  /**
   * @var 
   */
  private array $history = [];

  /**
   * @throws \Exception Value must be positive.
   */
  public function isHappy(int $value): bool
  {
    if($value < 0) {
      throw new \Exception("Value must be positive.");
    }

    $this->currentNumber = (string) $value;

    return $this->calculate();
  }

  private function calculate(): bool
  {
    $this->recordCurrentNumberInHistory();

    if($this->currentNumber == '1') {
      $this->clearHistory();
      return true;
    }

    $this->splitCurrentNumber();

    $this->squareDigits();

    $this->sumDigits();

    $this->clearDigits();

    if ($this->currentNumberAlreadyCalculated()) {
      return false;
    }

    return $this->calculate();
  }

  private function recordCurrentNumberInHistory(): void
  {
    $this->history[] = $this->currentNumber;
  }

  private function clearHistory(): void
  {
    $this->history = [];
  }

  private function splitCurrentNumber(): void
  {
    $this->digits = str_split((string) $this->currentNumber);
  }

  private function squareDigits(): void
  {
    foreach($this->digits as $position => $digit) {
      $digit = (int) $digit;
      $square = ($digit ** 2);
      $this->digits[$position] = (string) $square;
    }
  }

  private function sumDigits(): void
  {
    $sumDigitsResult = 0;
    foreach($this->digits as $position => $digit) {
      $sumDigitsResult += (int) $digit;
    }

    $this->currentNumber = (string) $sumDigitsResult;
  }

  private function clearDigits(): void
  {
    $this->digits = [];
  }

  private function currentNumberAlreadyCalculated(): bool
  {
    return in_array($this->currentNumber, $this->history);
  }
}
