<?php declare(strict_types=1);

namespace Tests\Unit\Multiples;

use TddExercises\Multiples\Chain;
use TddExercises\Multiples\Rule\MultipleOfThree;
use Tests\TestCase;

class ChainTest extends TestCase
{
  public function test_deve_retornar_false_quando_a_manipulação_não_for_satisfeita_e_não_houver_próximo_elemento_na_cadeia(): void
  {
    $oneElementChain = new MultipleOfThree();
    $this->assertFalse($oneElementChain->handle(2));
  }

  public function test_deve_chamar_a_manipulação_do_próximo_elemento_quando_a_manipulação_do_primeiro_elemento_não_for_satisfeita(): void
  {
    $firstElement = new MultipleOfThree();
    $secondElement = $this->createMock(Chain::class);
    $secondElement->method('handle')->willReturn(true);

    $firstElement->next($secondElement);

    $this->assertTrue($firstElement->handle(2));
  }
}
