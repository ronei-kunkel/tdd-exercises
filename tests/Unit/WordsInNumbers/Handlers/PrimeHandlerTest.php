<?php declare(strict_types=1);

namespace Tests\Unit\WordsInNumbers;

use stdClass;
use TddExercises\IntChecker;
use TddExercises\Multiples\Handler;
use TddExercises\Valuable;
use TddExercises\WordsInNumbers\Contentable;
use TddExercises\WordsInNumbers\Handler\PrimeHandler;
use TddExercises\WordsInNumbers\Word;
use Tests\TestCase;

class PrimeHandlerTest extends TestCase
{
  public function test_deve_retornar_false_se_o_input_não_for_instancia_de_Contentable(): void
  {
    $valuableMock = $this->createMock(Valuable::class);
    $IntCheckerMock = $this->createMock(IntChecker::class);
    $stdObject = new stdClass();

    $handler = new PrimeHandler($valuableMock, $IntCheckerMock);

    $this->assertFalse($handler->handle($stdObject));
  }

  public function test_se_não_for_uma_instancia_de_prime_nem_tiver_outro_handler_na_sequencia_deve_retornar_true(): void
  {
    $valuableMock = $this->createMock(Valuable::class);
    $IntCheckerMock = $this->createMock(IntChecker::class);
    $Contentable = $this->createMock(Contentable::class);

    $handler = new PrimeHandler($valuableMock, $IntCheckerMock);

    $this->assertTrue($handler->handle($Contentable));
  }

  public function test_se_for_um_prime_e_o_resultado_da_verificação_for_negativo_não_deve_modificar_o_input():void 
  {
    $valuableMock = $this->createMock(Valuable::class);
    $IntCheckerMock = $this->createMock(IntChecker::class);
    $IntCheckerMock->method('check')->willReturn(false);
    $word = new Word('b');

    $handler = new PrimeHandler($valuableMock, $IntCheckerMock);

    $handler->handle($word);

    $this->assertFalse($word->isPrime());
  }

  public function test_se_for_um_prime_e_o_resultado_da_verificação_for_positivo_deve_modificar_o_input():void 
  {
    $valuableMock = $this->createMock(Valuable::class);
    $IntCheckerMock = $this->createMock(IntChecker::class);
    $IntCheckerMock->method('check')->willReturn(true);
    $word = new Word('b');

    $handler = new PrimeHandler($valuableMock, $IntCheckerMock);

    $handler->handle($word);

    $this->assertTrue($word->isPrime());
  }

  public function test_deve_passar_para_o_proximo_handler_se_houver_proximo_handler(): void
  {
    $valuableMock = $this->createMock(Valuable::class);
    $IntCheckerMock = $this->createMock(IntChecker::class);
    $IntCheckerMock->method('check')->willReturn(true);
    $word = new Word('b');

    $handler = new PrimeHandler($valuableMock, $IntCheckerMock);
    $handler2 = $this->createMock(Handler::class);
    $handler2->method('handle')->willReturn(false);

    $handler->setNext($handler2);

    $this->assertFalse($handler->handle($word));
  }
}
