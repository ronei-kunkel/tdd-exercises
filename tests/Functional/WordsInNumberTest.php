<?php declare(strict_types=1);

namespace Tests\Functional;

use TddExercises\WordsInNumbers\SimpleAlphabetCharService;
use TddExercises\WordsInNumbers\WordService;
use TddExercises\WordsInNumbers\Word;

use Tests\TestCase;

class WordsInNumberTest extends TestCase
{
  public function test_valida_se_uma_palavra_é_prima_feliz_ou_divisivel_por_3_ou_5(): void
  {
    $j = new Word('j'); // 10
    $c = new Word('c'); // 3
    $g = new Word('g'); // 7

    $wordService = new WordService(new SimpleAlphabetCharService());

    $wordService->analyse($j);
    $wordService->analyse($c);
    $wordService->analyse($g);

    $this->assertFalse($j->isPrime());
    $this->assertTrue($j->isHappy());
    $this->assertTrue($j->isDivisibleBy3Or5());

    $this->assertTrue($c->isPrime());
    $this->assertFalse($c->isHappy());
    $this->assertTrue($c->isDivisibleBy3Or5());

    $this->assertTrue($g->isPrime());
    $this->assertTrue($g->isHappy());
    $this->assertFalse($g->isDivisibleBy3Or5());
  }
}
