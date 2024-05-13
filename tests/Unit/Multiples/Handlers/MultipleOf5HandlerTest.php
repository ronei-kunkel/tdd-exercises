<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Handlers;

use TddExercises\Multiples\Handler\MultipleOf5Handler;
use Tests\TestCase;

class MultipleOf5HandlerTest extends TestCase
{
  public function test_deve_validar_um_multiplo_de_5(): void
  {
    $multipleOf5Handler = new MultipleOf5Handler();

    $this->assertEquals(true, $multipleOf5Handler->handle(20));
    $this->assertEquals(false, $multipleOf5Handler->handle(16));
  }

  public function test_deve_retornar_false_caso_não_receber_um_numérico(): void
  {
    $multipleOf5Handler = new MultipleOf5Handler();

    $this->assertEquals(false, $multipleOf5Handler->handle('a'));
  }
}
