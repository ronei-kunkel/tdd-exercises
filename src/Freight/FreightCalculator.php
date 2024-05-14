<?php declare(strict_types=1);

namespace TddExercises\Freight;

final class FreightCalculator
{
  public function __construct(
    private FreightFeeApi $freightFeeApi
  ) {
  }
}
