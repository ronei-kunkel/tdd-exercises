<?php declare(strict_types=1);

namespace Tests\Unit\WordsInNumbers;

use TddExercises\WordsInNumbers\PrimeChecker;
use Tests\TestCase;

class PrimeCheckerTest extends TestCase
{
  
  public function test_deve_validar_numeros_primos(): void
  {
    $prime = new PrimeChecker();

    $this->assertTrue($prime->check(2));
    $this->assertTrue($prime->check(3));
    $this->assertTrue($prime->check(5));
    $this->assertTrue($prime->check(7));
    $this->assertTrue($prime->check(11));
    $this->assertFalse($prime->check(12));
    $this->assertFalse($prime->check(15));
    $this->assertFalse($prime->check(99));
  }
}
