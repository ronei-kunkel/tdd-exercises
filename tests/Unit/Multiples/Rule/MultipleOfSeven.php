<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Rule;

use TddExercises\Multiples\Chain;
use TddExercises\Multiples\Rule\MultipleOfSeven;
use Tests\TestCase;

class MultipleOfThreeTest extends TestCase
{
  public function test_deve_validar_um_número_múltiplo_de_três(): void
  {
    $multipleOfSeven = new MultipleOfSeven();

    $this->assertTrue($multipleOfSeven->handle(3));
    $this->assertFalse($multipleOfSeven->handle(4));
    $this->assertTrue($multipleOfSeven->handle(6));
    $this->assertFalse($multipleOfSeven->handle(8));
    $this->assertInstanceOf(Chain::class, $multipleOfSeven);
  }
}
