<?php

namespace App;

class GatewaysCollection implements GatewaysCollectionInterface
{
  private int $position = 0;
  private float $totalWeight = 0;
  private array $gateways = [];

  public function __construct(
    GatewayInterface ...$gateways,
  ) {
    foreach ($gateways as $gateway) {
      $this->append($gateway);
    }
  }

  public function append(GatewayInterface $gateway): bool
  {
    $newWeight = $this->totalWeight + $gateway->getWeight();

    if ($newWeight > self::MAX_WEIGHT) {
      return false;
    }

    $this->gateways[] = $gateway;

    $this->totalWeight = $newWeight;

    return true;
  }

  public function getWeight(): float
  {
    return $this->totalWeight;
  }

  public function rewind(): void
  {
    $this->position = 0;
  }

  public function current(): ?GatewayInterface
  {
    return $this->gateways[$this->position];
  }

  public function key(): int
  {
    return $this->position;
  }

  public function next(): void
  {
    ++$this->position;
  }

  public function valid(): bool
  {
    return isset($this->gateways[$this->position]);
  }

  public function count(): int
  {
    return \count($this->gateways);
  }
}
