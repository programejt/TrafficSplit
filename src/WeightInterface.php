<?php

namespace App;

interface WeightInterface
{
  public const int MAX_WEIGHT = 100;

  public function getWeight(): float;
}