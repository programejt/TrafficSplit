<?php

class GatewaysCollection extends ArrayObject
{
  public private(set) float $totalWeight = 0;

  public function __construct(
    Gateway ...$gateways,
  ) {
    foreach ($gateways as $gateway) {
      $this->append($gateway);
    }
  }

  public function append($gateway): void
  {
    if (!$gateway instanceof Gateway) {
      return;
    }

    $newWeight = $this->totalWeight + $gateway->weight;

    if ($newWeight > Gateway::MAX_WEIGHT) {
      return;
    }

    $this->totalWeight = $newWeight;

    parent::append($gateway);
  }
}
