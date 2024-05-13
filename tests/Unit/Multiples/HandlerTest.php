<?php declare(strict_types=1);

namespace Tests\Unit\Multiples;

use TddExercises\Multiples\Handler;
use Tests\TestCase;

class HandlerTest extends TestCase
{
  public function test_ao_definir_proximo_handler_deve_retornar_o_handler_definido_para_ter_interface_fluente(): void
  {
    $handler1 = $this->createMock(Handler::class);
    $handler2 = $this->createMock(Handler::class);
    $handler3 = $this->createMock(Handler::class);

    $handler1->method('setNext')->willReturn($handler2);
    $handler2->method('setNext')->willReturn($handler3);

    $this->assertEquals($handler3, $handler1->setNext($handler2)->setNext($handler3));
  }
}
