<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Handlers;

use TddExercises\Multiples\Handler\MultipleOf7Handler;
use Tests\TestCase;

class MultipleOf7HandlerTest extends TestCase
{
  public function test_deve_validar_um_multiplo_de_7(): void
  {
    $multipleOf7Handler = new MultipleOf7Handler();

    $this->assertEquals(true, $multipleOf7Handler->handle(14));
    $this->assertEquals(true, $multipleOf7Handler->handle(21));
    $this->assertEquals(false, $multipleOf7Handler->handle(16));
  }

  public function test_deve_retornar_false_caso_não_receber_um_numérico(): void
  {
    $multipleOf7Handler = new MultipleOf7Handler();

    $this->assertEquals(false, $multipleOf7Handler->handle('a'));
  }
}
