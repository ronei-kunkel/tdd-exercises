<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Condition;

use TddExercises\Multiples\Sum\ThreeOrFiveAndSevenSum;
use Tests\TestCase;

class ThreeOrFiveAndSevenSumTest extends TestCase
{
  public function test_deve_fazer_a_soma_dos_numeros_da_condição_três_ou_cinco_e_sete(): void
  {
    $threeOrFiveAndSevenConditionOf22 = new ThreeOrFiveAndSevenSum(22);
    $threeOrFiveAndSevenConditionOf36 = new ThreeOrFiveAndSevenSum(36);
    $threeOrFiveAndSevenConditionOf4 = new ThreeOrFiveAndSevenSum(4);
    $threeOrFiveAndSevenConditionOf6 = new ThreeOrFiveAndSevenSum(6);
    $threeOrFiveAndSevenConditionOf8 = new ThreeOrFiveAndSevenSum(8);

    $sum22 = $threeOrFiveAndSevenConditionOf22->sum();
    $sum36 = $threeOrFiveAndSevenConditionOf36->sum();
    $sum4 = $threeOrFiveAndSevenConditionOf4->sum();
    $sum6 = $threeOrFiveAndSevenConditionOf6->sum();
    $sum8 = $threeOrFiveAndSevenConditionOf8->sum();

    $this->assertEquals(21, $sum22);
    $this->assertEquals(56, $sum36);
    $this->assertEquals(0, $sum4);
    $this->assertEquals(0, $sum6);
    $this->assertEquals(0, $sum8);
  }
}
