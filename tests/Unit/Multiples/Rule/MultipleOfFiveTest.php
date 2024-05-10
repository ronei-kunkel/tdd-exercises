<?php declare(strict_types=1);

namespace Tests\Unit\Multiples;

use TddExercises\Multiples\Chain;
use TddExercises\Multiples\Rule\MultipleOfFive;
use Tests\TestCase;

class MultipleOfFiveTest extends TestCase
{
  public function test_deve_validar_um_número_múltiplo_de_cinco(): void
  {
    $multipleOfFive = new MultipleOfFive();

    $this->assertTrue($multipleOfFive->handle(5));
    $this->assertFalse($multipleOfFive->handle(6));
    $this->assertFalse($multipleOfFive->handle(9));
    $this->assertTrue($multipleOfFive->handle(10));
    $this->assertInstanceOf(Chain::class, $multipleOfFive);
  }
}
