<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Condition;

use TddExercises\Multiples\Condition\Fiveteen;
use Tests\TestCase;

class ThreeAndFiveTest extends TestCase
{
  public function test_deve_fazer_a_soma_dos_numeros_da_condição_três_e_cinco(): void
  {
    $fiveteenCondition = new Fiveteen(100);

    $sum = $fiveteenCondition->sum();

    $this->assertEquals($sum, 315);
  }
}
