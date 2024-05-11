<?php declare(strict_types=1);

namespace Tests\Unit\WordsInNumbers;

use TddExercises\WordsInNumbers\SimpleAlphabetCharService;
use Tests\TestCase;

class SimpleAlphabetCharServiceTest extends TestCase
{

  public function test_a_minúsculo_deve_ter_valor_1(): void
  {
    $charService = new SimpleAlphabetCharService();

    $value = $charService->valueOf('a');

    $this->assertEquals(1, $value);
  }

  public function test_k_minúsculo_deve_ter_valor_11(): void
  {
    $charService = new SimpleAlphabetCharService();

    $value = $charService->valueOf('k');

    $this->assertEquals(11, $value);
  }

  public function test_z_minúsculo_deve_ter_valor_26(): void
  {
    $charService = new SimpleAlphabetCharService();

    $value = $charService->valueOf('z');

    $this->assertEquals(26, $value);
  }

  public function test_a_maiúsculo_deve_ter_valor_27(): void
  {
    $charService = new SimpleAlphabetCharService();

    $value = $charService->valueOf('A');

    $this->assertEquals(27, $value);
  }

  public function test_z_maiúsculo_deve_ter_valor_52(): void
  {
    $charService = new SimpleAlphabetCharService();

    $value = $charService->valueOf('Z');

    $this->assertEquals(52, $value);
  }

  public function test_caracteres_especiais_devem_ter_valor_0(): void
  {
    $charService = new SimpleAlphabetCharService();

    $this->assertEquals(0, $charService->valueOf(','));
    $this->assertEquals(0, $charService->valueOf('!'));
    $this->assertEquals(0, $charService->valueOf('.'));
    $this->assertEquals(0, $charService->valueOf('?'));
  }

  public function test_valores_com_mais_de_um_caractere_devem_retornar_0(): void
  {
    $charService = new SimpleAlphabetCharService();

    $this->assertEquals(0, $charService->valueOf('aa'));
    $this->assertEquals(0, $charService->valueOf('iauh'));
    $this->assertEquals(0, $charService->valueOf('ioea aoiej'));
  }
}
