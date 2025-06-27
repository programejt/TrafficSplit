<?php

class Payment
{
  public function __construct(
    public readonly float $amount,
  ) {}
}
