<?php declare(strict_types=1);

namespace Tests\Unit\WordsInNumbers;

use TddExercises\WordsInNumbers\Word;
use Tests\TestCase;

class WordTest extends TestCase
{
  public function test_deve_retornar_o_conteúdo_de_uma_palavra(): void
  {
    $word = new Word("impressora");

    $this->assertEquals('impressora', $word->getContent());
  }

  public function test_deve_definir_uma_palavra_como_prima(): void
  {
    $word = new Word("impressora");
    $word->defineAsPrime();

    $this->assertEquals(true, $word->isPrime());
    $this->assertEquals(false, $word->isHappy());
    $this->assertEquals(false, $word->isDivisibleBy3or5());
  }

  public function test_deve_definir_uma_palavra_como_feliz(): void
  {
    $word = new Word("impressora");
    $word->defineAsHappy();

    $this->assertEquals(false, $word->isPrime());
    $this->assertEquals(true, $word->isHappy());
    $this->assertEquals(false, $word->isDivisibleBy3or5());
  }

  public function test_deve_definir_uma_palavra_como_divisivel_por_3_ou_5(): void
  {
    $word = new Word("impressora");
    $word->defineAsDivisibleBy3Or5();

    $this->assertEquals(false, $word->isPrime());
    $this->assertEquals(false, $word->isHappy());
    $this->assertEquals(true, $word->isDivisibleBy3or5());
  }
}
