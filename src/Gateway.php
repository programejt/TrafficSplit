<?php

namespace App;

class Gateway implements GatewayInterface
{
  public readonly float $weight;
  private array $payments = [];
  private int $load = 0;

  public function __construct(
    public readonly string $name,
    float $weight,
  ) {
    $this->weight = match (true) {
      $weight < 0                => 0,
      $weight > self::MAX_WEIGHT => self::MAX_WEIGHT,
      default                    => $weight,
    };
  }

  public function getWeight(): float
  {
    return $this->weight;
  }

  public function addPayment(Payment $payment): void
  {
    $this->payments[] = $payment;
    $this->load++;
  }

  public function getTrafficLoad(): int
  {
    return $this->load;
  }

  public function __toString(): string
  {
    return $this->name;
  }
}
