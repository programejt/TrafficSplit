<?php

namespace App;

class GatewaysCollection extends \ArrayObject implements WeightInterface
{
  private float $totalWeight = 0;

  public function __construct(
    GatewayInterface ...$gateways,
  ) {
    foreach ($gateways as $gateway) {
      $this->append($gateway);
    }
  }

  public function append($gateway): void
  {
    if (!$this->isValidGateway($gateway)) {
      return;
    }

    $newWeight = $this->totalWeight + $gateway->getWeight();

    if ($newWeight > self::MAX_WEIGHT) {
      return;
    }

    $this->totalWeight = $newWeight;

    parent::append($gateway);
  }

  public function offsetSet($key, $value): void
  {
    if (!$this->isValidGateway($value)) {
      return;
    }

    parent::offsetSet($key, $value);
  }

  public function isValidGateway($gateway): bool
  {
    return $gateway instanceof GatewayInterface;
  }

  public function getWeight(): float
  {
    return $this->totalWeight;
  }
}
