<?php declare(strict_types=1);

namespace Tests\Unit\Multiples;

use TddExercises\Multiples\Condition\ThreeOrFiveAndSeven;
use Tests\TestCase;

class ThreeOrFiveTest extends TestCase
{
  public function test_deve_fazer_a_soma_dos_numeros_da_condição_três_ou_cinco_e_sete(): void
  {
    $threeOrFiveAndSevenConditionOf21 = new ThreeOrFiveAndSeven(21);
    $threeOrFiveAndSevenConditionOf35 = new ThreeOrFiveAndSeven(35);
    $threeOrFiveAndSevenConditionOf3 = new ThreeOrFiveAndSeven(3);
    $threeOrFiveAndSevenConditionOf5 = new ThreeOrFiveAndSeven(5);
    $threeOrFiveAndSevenConditionOf7 = new ThreeOrFiveAndSeven(7);

    $sum21 = $threeOrFiveAndSevenConditionOf21->sum();
    $sum35 = $threeOrFiveAndSevenConditionOf35->sum();
    $sum3 = $threeOrFiveAndSevenConditionOf3->sum();
    $sum5 = $threeOrFiveAndSevenConditionOf5->sum();
    $sum7 = $threeOrFiveAndSevenConditionOf7->sum();

    $this->assertEquals($sum21, 21);
    $this->assertEquals($sum35, 35);
    $this->assertEquals($sum3, 0);
    $this->assertEquals($sum5, 0);
    $this->assertEquals($sum7, 0);
  }
}
