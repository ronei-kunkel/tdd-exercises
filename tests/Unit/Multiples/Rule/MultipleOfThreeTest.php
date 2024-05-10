<?php declare(strict_types=1);

namespace Tests\Unit\Multiples;

use TddExercises\Multiples\Chain;
use TddExercises\Multiples\Rule\MultipleOfThree;
use Tests\TestCase;

class MultipleOfThreeTest extends TestCase
{
  public function test_deve_validar_um_número_múltiplo_de_três(): void
  {
    $multipleOfThree = new MultipleOfThree();

    $this->assertTrue($multipleOfThree->handle(3));
    $this->assertFalse($multipleOfThree->handle(4));
    $this->assertTrue($multipleOfThree->handle(6));
    $this->assertFalse($multipleOfThree->handle(8));
    $this->assertInstanceOf(Chain::class, $multipleOfThree);
  }
}
