<?php declare(strict_types=1);

namespace Tests\Functional;

use TddExercises\Multiples\Sum\FiveteenSum;
use TddExercises\Multiples\Sum\ThreeOrFiveSum;
use TddExercises\Multiples\Sum\ThreeOrFiveAndSevenSum;
use Tests\TestCase;

class MultiplesTest extends TestCase
{

  public function test_valida_a_soma_de_multiplos_de_3_ou_5_abaixo_de_1000()
  {
    $threeOrFiveCondition = new ThreeOrFiveSum(1000);

    $sum = $threeOrFiveCondition->sum();

    $this->assertEquals($sum, 233168);
  }

  public function test_valida_a_soma_de_multiplos_de_3_e_5_abaixo_de_1000()
  {
    $fiveteenCondition = new FiveteenSum(1000);

    $sum = $fiveteenCondition->sum();

    $this->assertEquals($sum, 33165);
  }

  public function test_valida_a_soma_de_multiplos_de_3_ou_5_e_7_abaixo_de_1000()
  {
    $threeOrFiveAndSeven = new ThreeOrFiveAndSevenSum(1000);

    $sum = $threeOrFiveAndSeven->sum();

    $this->assertEquals($sum, 33173);
  }
}
