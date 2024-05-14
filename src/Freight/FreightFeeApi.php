<?php declare(strict_types=1);

namespace TddExercises\Freight;

interface FreightFeeApi
{
  public function quoteFor(string $cep): int;
}
