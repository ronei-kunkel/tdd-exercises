<?php declare(strict_types=1);

namespace Tests\Unit\Happy;

use Exception;
use TddExercises\Happy\HappyChecker;
use Tests\TestCase;

class HappyCheckerTest extends TestCase
{

  public function test_deve_lançar_exceção_quando_for_numero_negativo(): void
  {
    $happyChecker = new HappyChecker();

    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Value must be positive.");
    $happyChecker->check(-1);
  }

  public function test_deve_retornar_true_quando_1(): void
  {
    $happyChecker = new HappyChecker();

    $result = $happyChecker->check(1);

    $this->assertTrue($result);
  }

  public function test_valida_vários_números_felizes_e_infelizes(): void
  {
    $happyChecker = new HappyChecker();

    $this->assertTrue($happyChecker->check(1));
    $this->assertTrue($happyChecker->check(7));
    $this->assertTrue($happyChecker->check(10));
    $this->assertTrue($happyChecker->check(13));
    $this->assertTrue($happyChecker->check(19));
    $this->assertTrue($happyChecker->check(23));
    $this->assertTrue($happyChecker->check(28));
    $this->assertTrue($happyChecker->check(31));
    $this->assertTrue($happyChecker->check(32));
    $this->assertTrue($happyChecker->check(44));
    $this->assertTrue($happyChecker->check(49));
    $this->assertTrue($happyChecker->check(68));
    $this->assertTrue($happyChecker->check(70));

    $this->assertFalse($happyChecker->check(2));
    $this->assertFalse($happyChecker->check(3));
    $this->assertFalse($happyChecker->check(4));
    $this->assertFalse($happyChecker->check(5));
    $this->assertFalse($happyChecker->check(6));
    $this->assertFalse($happyChecker->check(8));
    $this->assertFalse($happyChecker->check(9));
    $this->assertFalse($happyChecker->check(11));
    $this->assertFalse($happyChecker->check(12));
    $this->assertFalse($happyChecker->check(14));
    $this->assertFalse($happyChecker->check(15));
    $this->assertFalse($happyChecker->check(16));
    $this->assertFalse($happyChecker->check(17));
    $this->assertFalse($happyChecker->check(18));
    $this->assertFalse($happyChecker->check(20));
  }
}
