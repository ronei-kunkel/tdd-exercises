<?php declare(strict_types=1);

namespace Tests\Unit\Freight;

use TddExercises\Freight\Cart\Cart;
use TddExercises\Freight\FreightCalculator;
use TddExercises\Freight\FreightFeeApi;
use TddExercises\Freight\User;
use Tests\TestCase;

class FreightCalculatorTest extends TestCase
{
  public function test_fee_should_be_calculated_by_external_service_when_cart_amount_less_than_100(): void
  {
    $cartWith9999amountMock = $this->getMockBuilder(Cart::class)
      ->setConstructorArgs([$this->createMock(User::class)])
      ->getMock();
    $cartWith9999amountMock->method('getAmount')->willReturn(9999); // R$99,99

    $correiosApiMock = $this->createMock(FreightFeeApi::class);
    $correiosApiMock->method('quoteFor')->willReturn(1500); // R$15,00

    $freightCalculator = new FreightCalculator($correiosApiMock);

    $cart9999CalculatedAmount = $freightCalculator->calculate($cartWith9999amount);

    $this->assertEquals(11499, $cart9999CalculatedAmount);
    $correiosApiMock->expects($this->once())->method('quoteFor');
    $cartWith9999amountMock->expects($this->once())->method('getAmount');
  }

  public function test_fee_should_not_be_calculated_by_external_service_when_cart_amount_greater_or_equal_to_100(): void
  {
    $cartWith10000amountMock = $this->getMockBuilder(Cart::class)
      ->setConstructorArgs([$this->createMock(User::class)])
      ->getMock();
    $cartWith10000amountMock->method('getAmount')->willReturn(10000); // R$100,00

    $cartWith10001amountMock = $this->getMockBuilder(Cart::class)
      ->setConstructorArgs([$this->createMock(User::class)])
      ->getMock();
    $cartWith10001amountMock->method('getAmount')->willReturn(10001); // R$100,01

    $correiosApiMock = $this->createMock(FreightFeeApi::class);

    $freightCalculator = new FreightCalculator($correiosApiMock);

    $cart10000CalculatedAmount = $freightCalculator->calculateAmount($cartWith10000amount);

    $cart10001CalculatedAmount = $freightCalculator->calculateAmount($cartWith10001amount);

    $this->assertEquals(10000, $cart10000CalculatedAmount);
    $this->assertEquals(10001, $cart10001CalculatedAmount);
    $correiosApiMock->expects($this->never())->method('quoteFor');
    $cartWith10000amountMock->expects($this->once())->method('getAmount');
    $cartWith10001amountMock->expects($this->once())->method('getAmount');
  }
}
