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
    /**
     * @var Cart|\PHPUnit\Framework\MockObject\MockObject
     */
    $cartWith9999amountMock = $this->getMockBuilder(Cart::class)
      ->setConstructorArgs([$this->createMock(User::class)])
      ->getMock();
    $cartWith9999amountMock->method("getDeliveryCep")->willReturn('99999999');
    $cartWith9999amountMock->method("isEmpty")->willReturn(false);
    $cartWith9999amountMock->method('getAmount')->willReturn(9999); // R$99,99
    $cartWith9999amountMock->expects($this->once())->method('getAmount');

    $correiosApiMock = $this->createMock(FreightFeeApi::class);
    $correiosApiMock->method('quoteFor')->willReturn(1500); // R$15,00
    $correiosApiMock->expects($this->once())->method('quoteFor');

    $freightCalculator = new FreightCalculator($correiosApiMock);

    $cart9999CalculatedAmount = $freightCalculator->calculateAmount($cartWith9999amountMock);

    $this->assertEquals(11499, $cart9999CalculatedAmount);
  }

  public function test_fee_should_not_be_calculated_by_external_service_when_cart_amount_greater_or_equal_to_100(): void
  {
    /**
     * @var Cart|\PHPUnit\Framework\MockObject\MockObject
     */
    $cartWith10000amountMock = $this->getMockBuilder(Cart::class)
      ->setConstructorArgs([$this->createMock(User::class)])
      ->getMock();
    $cartWith10000amountMock->method('getAmount')->willReturn(10000); // R$100,00
    $cartWith10000amountMock->expects($this->once())->method('getAmount');

    /**
     * @var Cart|\PHPUnit\Framework\MockObject\MockObject
     */
    $cartWith10001amountMock = $this->getMockBuilder(Cart::class)
      ->setConstructorArgs([$this->createMock(User::class)])
      ->getMock();
    $cartWith10001amountMock->method('getAmount')->willReturn(10001); // R$100,01
    $cartWith10001amountMock->expects($this->once())->method('getAmount');

    $correiosApiMock = $this->createMock(FreightFeeApi::class);
    $correiosApiMock->expects($this->never())->method('quoteFor');

    $freightCalculator = new FreightCalculator($correiosApiMock);

    $cart10000CalculatedAmount = $freightCalculator->calculateAmount($cartWith10000amountMock);

    $cart10001CalculatedAmount = $freightCalculator->calculateAmount($cartWith10001amountMock);

    $this->assertEquals(10000, $cart10000CalculatedAmount);
    $this->assertEquals(10001, $cart10001CalculatedAmount);
  }

  public function test_cant_calculate_empty_cart(): void
  {
    /**
     * @var Cart|\PHPUnit\Framework\MockObject\MockObject
     */
    $cartWith0amountMock = $this->getMockBuilder(Cart::class)
      ->setConstructorArgs([$this->createMock(User::class)])
      ->getMock();
    $cartWith0amountMock->method('getAmount')->willReturn(0); // R$99,99
    $cartWith0amountMock->method('isEmpty')->willReturn(true);

    $correiosApiMock = $this->createMock(FreightFeeApi::class);

    $freightCalculator = new FreightCalculator($correiosApiMock);

    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Cannot calculate empty cart. Add products to cart to be able to calculate fee');

    $freightCalculator->calculateAmount($cartWith0amountMock);

    $correiosApiMock->expects($this->never())->method('quoteFor');
    $cartWith0amountMock->expects($this->once())->method('isEmpty');
  }
}
