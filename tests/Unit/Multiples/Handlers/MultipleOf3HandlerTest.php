<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Handlers;

use TddExercises\Multiples\Handler\MultipleOf3Handler;
use Tests\TestCase;

class MultipleOf3HandlerTest extends TestCase
{
  public function test_deve_validar_um_multiplo_de_3(): void
  {
    $multipleOf3Handler = new MultipleOf3Handler();

    $this->assertEquals(true, $multipleOf3Handler->handle(9));
    $this->assertEquals(false, $multipleOf3Handler->handle(8));
  }

  public function test_deve_retornar_false_caso_não_receber_um_numérico(): void
  {
    $multipleOf3Handler = new MultipleOf3Handler();

    $this->assertEquals(false, $multipleOf3Handler->handle('a'));
  }
}
