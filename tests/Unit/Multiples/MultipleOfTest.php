<?php declare(strict_types=1);

namespace Tests\Unit\Multiples;

use TddExercises\Multiples\MultipleOf;
use Tests\TestCase;

class MultipleOfTest extends TestCase
{
  public function test_deve_retornar_true_quando_um_numero_for_multiplo(): void
  {
    $multipleOf = new MultipleOf(7);
    $this->assertEquals(true, $multipleOf->check(49));
  }

  public function test_deve_retornar_falso_quando_um_numero_nao_for_multiplo(): void
  {
    $multipleOf = new MultipleOf(4);
    $this->assertEquals(false, $multipleOf->check(11));
  }
}
