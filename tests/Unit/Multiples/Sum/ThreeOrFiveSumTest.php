<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Condition;

use TddExercises\Multiples\Sum\ThreeOrFiveSum;
use Tests\TestCase;

class ThreeOrFiveSumTest extends TestCase
{
  public function test_deve_fazer_a_soma_dos_numeros_da_condição_três_ou_cinco(): void
  {
    $threeOrFiveCondition = new ThreeOrFiveSum(10);

    $sum = $threeOrFiveCondition->sum();

    $this->assertEquals($sum, 23);
  }
}
