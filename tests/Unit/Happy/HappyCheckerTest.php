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
    $happyChecker->isHappy(-1);
  }

  public function test_deve_retornar_true_quando_1(): void
  {
    $happyChecker = new HappyChecker();

    $result = $happyChecker->isHappy(1);

    $this->assertTrue($result);
  }

  public function test_valida_vários_números_felizes_e_infelizes(): void
  {
    $happyChecker = new HappyChecker();

    $this->assertTrue($happyChecker->isHappy(1));
    $this->assertTrue($happyChecker->isHappy(7));
    $this->assertTrue($happyChecker->isHappy(10));
    $this->assertTrue($happyChecker->isHappy(13));
    $this->assertTrue($happyChecker->isHappy(19));
    $this->assertTrue($happyChecker->isHappy(23));
    $this->assertTrue($happyChecker->isHappy(28));
    $this->assertTrue($happyChecker->isHappy(31));
    $this->assertTrue($happyChecker->isHappy(32));
    $this->assertTrue($happyChecker->isHappy(44));
    $this->assertTrue($happyChecker->isHappy(49));
    $this->assertTrue($happyChecker->isHappy(68));
    $this->assertTrue($happyChecker->isHappy(70));

    $this->assertFalse($happyChecker->isHappy(2));
    $this->assertFalse($happyChecker->isHappy(3));
    $this->assertFalse($happyChecker->isHappy(4));
    $this->assertFalse($happyChecker->isHappy(5));
    $this->assertFalse($happyChecker->isHappy(6));
    $this->assertFalse($happyChecker->isHappy(8));
    $this->assertFalse($happyChecker->isHappy(9));
    $this->assertFalse($happyChecker->isHappy(11));
    $this->assertFalse($happyChecker->isHappy(12));
    $this->assertFalse($happyChecker->isHappy(14));
    $this->assertFalse($happyChecker->isHappy(15));
    $this->assertFalse($happyChecker->isHappy(16));
    $this->assertFalse($happyChecker->isHappy(17));
    $this->assertFalse($happyChecker->isHappy(18));
    $this->assertFalse($happyChecker->isHappy(20));
  }
}
