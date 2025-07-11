<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\Gateway;
use App\Payment;

final class GatewayTest extends TestCase
{
  public function testValid(): void
  {
    $gateway = new Gateway('1', 50);

    $this->assertSame(50.0, $gateway->weight);
    $this->assertSame('1', (string) $gateway);
    $this->assertSame(0, $gateway->getTrafficLoad());
  }

  public function testWeightTooLow(): void
  {
    $gateway = new Gateway('1', -50);

    $this->assertSame(0.0, $gateway->weight);
    $this->assertSame('1', (string) $gateway);
    $this->assertSame(0, $gateway->getTrafficLoad());
  }

  public function testWeightTooHigh(): void
  {
    $gateway = new Gateway('1', 150);

    $this->assertSame(100.0, $gateway->weight);
    $this->assertSame('1', (string) $gateway);
    $this->assertSame(0, $gateway->getTrafficLoad());
  }

  public function testAddPayment(): void
  {
    $gateway = new Gateway('1', 50);

    $gateway->addPayment(new Payment(20));

    $this->assertSame(50.0, $gateway->weight);
    $this->assertSame('1', (string) $gateway);
    $this->assertSame(1, $gateway->getTrafficLoad());
  }
}
