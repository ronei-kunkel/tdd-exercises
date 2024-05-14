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

  public function test_cannot_create_user_with_invalid_cep(): void
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage('Invalid value for user cep. Value must be composite by 8 numeric digits');

    new User('Test User', '99999-000');
  }
}
