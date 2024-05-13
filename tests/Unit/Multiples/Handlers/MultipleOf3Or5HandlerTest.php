<?php declare(strict_types=1);

namespace Tests\Unit\Multiples\Handlers;

use TddExercises\Multiples\Handler\MultipleOf3Or5Handler;
use Tests\TestCase;

class MultipleOf3Or5HandlerTest extends TestCase
{
  public function test_deve_validar_um_multiplo_de_3_ou_5(): void
  {
    $multipleOf3Or5Handler = new MultipleOf3Or5Handler();

    $this->assertEquals(true, $multipleOf3Or5Handler->handle(3));
    $this->assertEquals(true, $multipleOf3Or5Handler->handle(5));
    $this->assertEquals(true, $multipleOf3Or5Handler->handle(15));
    $this->assertEquals(true, $multipleOf3Or5Handler->handle(21));
    $this->assertEquals(false, $multipleOf3Or5Handler->handle(14));
  }

  public function test_deve_retornar_false_caso_não_receber_um_numérico(): void
  {
    $multipleOf3Or5Handler = new MultipleOf3Or5Handler();

    $this->assertEquals(false, $multipleOf3Or5Handler->handle('a'));
  }
}
