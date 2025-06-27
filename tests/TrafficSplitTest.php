<?php

use PHPUnit\Framework\TestCase;

final class TrafficSplitTest extends TestCase
{
  public function testEqualLoadDistribution(): void
  {
    $gateways = new GatewaysCollection(
      new Gateway('Gateway 1', 25),
      new Gateway('Gateway 2', 25),
      new Gateway('Gateway 3', 25),
      new Gateway('Gateway 4', 25),
    );

    $trafficSplit = new TrafficSplit($gateways);
    $payment = new Payment(1);

    for ($i = 0; $i < 1000; $i++) {
      $trafficSplit->handlePayment($payment);
    }

    foreach ($gateways as $gateway) {
      $this->assertGreaterThanOrEqual(210, $gateway->getTrafficLoad());
      $this->assertLessThanOrEqual(290, $gateway->getTrafficLoad());
    }
  }

  public function testWeightedLoadDistribution(): void
  {
    $gateway1 = new Gateway('Gateway 1', 75);
    $gateway2 = new Gateway('Gateway 2', 10);
    $gateway3 = new Gateway('Gateway 3', 15);

    $gateways = new GatewaysCollection(
      $gateway1,
      $gateway2,
      $gateway3,
    );

    $trafficSplit = new TrafficSplit($gateways);
    $payment = new Payment(1);

    for ($i = 0; $i < 1000; $i++) {
      $trafficSplit->handlePayment($payment);
    }

    $this->assertGreaterThanOrEqual(600, $gateway1->getTrafficLoad());
    $this->assertLessThanOrEqual(800, $gateway1->getTrafficLoad());

    $this->assertGreaterThanOrEqual(50, $gateway2->getTrafficLoad());
    $this->assertLessThanOrEqual(150, $gateway2->getTrafficLoad());

    $this->assertGreaterThanOrEqual(100, $gateway3->getTrafficLoad());
    $this->assertLessThanOrEqual(200, $gateway3->getTrafficLoad());
  }

  public function testEmptyGateways(): void
  {
    $gateways = new GatewaysCollection();

    $trafficSplit = new TrafficSplit($gateways);

    $this->assertNull($trafficSplit->handlePayment(new Payment(1)));
  }
}
