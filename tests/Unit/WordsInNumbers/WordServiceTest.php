<?php declare(strict_types=1);

namespace Tests\Unit\WordsInNumbers;

use TddExercises\Valuable;
use TddExercises\WordsInNumbers\Word;
use TddExercises\WordsInNumbers\WordService;
use Tests\TestCase;

class WordServiceTest extends TestCase
{
  public function test_deve_passar_por_todas_as_análises(): void
  {
    $charService = $this->createMock(Valuable::class);

    $charService->method('valueOf')->willReturn(13);

    $charService->expects($this->exactly(3))->method('valueOf');

    $wordService = new WordService($charService);

    $word = new Word('teste');

    $wordService->analyse($word);
  }
}
