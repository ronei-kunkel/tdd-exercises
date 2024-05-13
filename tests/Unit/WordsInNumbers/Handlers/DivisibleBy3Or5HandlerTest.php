<?php declare(strict_types=1);

namespace Tests\Unit\WordsInNumbers;

use stdClass;
use TddExercises\Multiples\Handler;
use TddExercises\Valuable;
use TddExercises\WordsInNumbers\Contentable;
use TddExercises\WordsInNumbers\Handler\DivisibleBy3Or5Handler;
use TddExercises\WordsInNumbers\Word;
use Tests\TestCase;

class DivisibleBy3Or5HandlerTest extends TestCase
{
  public function test_deve_retornar_false_se_o_input_não_for_instancia_de_Contentable(): void
  {
    $valuableMock = $this->createMock(Valuable::class);
    $handlerMock  = $this->createMock(Handler::class);

    $stdObject = new stdClass();

    $handler = new DivisibleBy3Or5Handler($valuableMock, $handlerMock);

    $this->assertFalse($handler->handle($stdObject));
  }

  public function test_se_não_for_uma_instancia_de_prime_nem_tiver_outro_handler_na_sequencia_deve_retornar_true(): void
  {
    $valuableMock = $this->createMock(Valuable::class);
    $handlerMock  = $this->createMock(Handler::class);
    $Contentable  = $this->createMock(Contentable::class);

    $handler = new DivisibleBy3Or5Handler($valuableMock, $handlerMock);

    $this->assertTrue($handler->handle($Contentable));
  }

  public function test_se_for_um_divisible_e_o_resultado_da_verificação_for_negativo_não_deve_modificar_o_input(): void
  {
    $valuableMock = $this->createMock(Valuable::class);
    $handlerMock  = $this->createMock(Handler::class);
    $handlerMock->method('handle')->willReturn(false);
    $word = new Word('b');

    $handler = new DivisibleBy3Or5Handler($valuableMock, $handlerMock);

    $handler->handle($word);

    $this->assertFalse($word->isDivisibleBy3Or5());
  }

  public function test_se_for_um_divisible_e_o_resultado_da_verificação_for_positivo_deve_modificar_o_input(): void
  {
    $valuableMock = $this->createMock(Valuable::class);
    $handlerMock  = $this->createMock(Handler::class);
    $handlerMock->method('handle')->willReturn(true);
    $word = new Word('b');

    $handler = new DivisibleBy3Or5Handler($valuableMock, $handlerMock);

    $handler->handle($word);

    $this->assertTrue($word->isDivisibleBy3Or5());
  }

  public function test_deve_passar_para_o_proximo_handler_se_houver_proximo_handler(): void
  {
    $valuableMock = $this->createMock(Valuable::class);
    $handlerMock  = $this->createMock(Handler::class);
    $handlerMock->method('handle')->willReturn(true);
    $word = new Word('b');

    $handler1 = new DivisibleBy3Or5Handler($valuableMock, $handlerMock);
    $handler2 = $this->createMock(Handler::class);
    $handler2->method('handle')->willReturn(false);

    $handler1->setNext($handler2);

    $this->assertFalse($handler1->handle($word));
  }
}
