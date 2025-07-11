<?php

namespace App;

class TrafficSplit
{
  public function __construct(
    private GatewaysCollection $gateways,
  ) {}

  public function handlePayment(Payment $payment): ?GatewayInterface
  {
    $randomValue = \rand(1, $this->gateways->getWeight());
    $currentWeight = 0;

    foreach ($this->gateways as $gateway) {
      $currentWeight += $gateway->getWeight();

      if ($randomValue <= $currentWeight) {
        $gateway->addPayment($payment);

        return $gateway;
      }
    }

    return null;
  }
}
