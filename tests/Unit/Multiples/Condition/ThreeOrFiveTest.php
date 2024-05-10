<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Condition;

use TddExercises\Multiples\Condition\ThreeOrFive;
use Tests\TestCase;

class ThreeOrFiveTest extends TestCase
{
  public function test_deve_fazer_a_soma_dos_numeros_da_condição_três_ou_cinco(): void
  {
    $threeOrFiveCondition = new ThreeOrFive(10);

    $sum = $threeOrFiveCondition->sum();

    $this->assertEquals($sum, 23);
  }
}
