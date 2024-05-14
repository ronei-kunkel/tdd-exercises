<?php declare(strict_types=1);

namespace Tests\Unit\Freight;

use TddExercises\Freight\User;
use Tests\TestCase;

class UserTest extends TestCase
{
  public function test_create_valid_user(): void
  {
    $user = new User('Test User', '99999000');

    $this->assertEquals('Test User', $user->name());
    $this->assertEquals('99999000', $user->cep());
  }
}
