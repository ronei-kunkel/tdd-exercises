<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Rule;

use TddExercises\Multiples\Chain;
use TddExercises\Multiples\Rule\MultipleOfFiveteen;
use Tests\TestCase;

class MultipleOfFiveteenTest extends TestCase
{
  public function test_deve_validar_um_número_múltiplo_de_quinze_que_é_três_e_cinco(): void
  {
    $multipleOfFiveteen = new MultipleOfFiveteen();

    $this->assertTrue($multipleOfFiveteen->handle(15));
    $this->assertTrue($multipleOfFiveteen->handle(30));
    $this->assertTrue($multipleOfFiveteen->handle(45));
    $this->assertFalse($multipleOfFiveteen->handle(27));
    $this->assertInstanceOf(Chain::class, $multipleOfFiveteen);
  }
}
