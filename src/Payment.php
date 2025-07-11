<?php

namespace App;

class Payment
{
  public function __construct(
    public readonly float $amount,
  ) {}
}
