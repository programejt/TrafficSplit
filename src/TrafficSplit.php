<?php

class TrafficSplit
{
  public function __construct(
    private GatewaysCollection $gateways,
  ) {}

  public function handlePayment(Payment $payment): ?Gateway
  {
    $randomValue = rand(1, $this->gateways->totalWeight);
    $currentWeight = 0;

    foreach ($this->gateways as $gateway) {
      $currentWeight += $gateway->weight;

      if ($randomValue <= $currentWeight) {
        $gateway->addPayment($payment);

        return $gateway;
      }
    }

    return null;
  }
}
