<?php declare(strict_types=1);

namespace Tests\Unit\Multiples;

use InvalidArgumentException;
use TddExercises\Multiples\Conditional;
use TddExercises\Multiples\SumChain;
use Tests\TestCase;

class SumChainTest extends TestCase
{
  public function test_deve_instanciar_uma_cadeia_de_soma_sem_condicionais()
  {
    $sumChain = new SumChain(2);

    $this->assertEquals(3, $sumChain->result());
    $this->assertEquals(0, $sumChain->quantityOfConditionals());
  }

  public function test_nao_deve_instanciar_uma_cadeia_de_soma_com_número_que_não_seja_natural()
  {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('The number for the sum has to be natural.');

    $sumChain = new SumChain(-1);
  }

  public function test_deve_adicionar_uma_condicional_na_cadeia_de_soma()
  {
    $mockedConditional = $this->createMock(Conditional::class);
    $mockedConditional->method('handle')->willReturn(true);

    $sumChain = new SumChain(2);
    $sumChain->addConditional($mockedConditional);

    $mockedConditional->expects($this->exactly(3))->method('handle');
    $this->assertEquals(3, $sumChain->result());
    $this->assertEquals(1, $sumChain->quantityOfConditionals());
  }
}
