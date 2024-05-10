<?php declare(strict_types=1);

namespace Tests\Functional;

use TddExercises\Happy\HappyChecker;
use Tests\TestCase;

class HappyTest extends TestCase
{
  public function test_deve_confirmar_que_7_é_um_número_feliz(): void
  {
    $happyChecker = new HappyChecker();

    $result = $happyChecker->isHappy(7);

    $this->assertTrue($result);
  }

  public function test_deve_confirmar_que_4_não_é_um_número_feliz(): void
  {
    $happyChecker = new HappyChecker();

    $result = $happyChecker->isHappy(4);

    $this->assertFalse($result);
  }
}
