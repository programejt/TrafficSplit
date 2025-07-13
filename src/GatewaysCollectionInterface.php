<?php

namespace App;

interface GatewaysCollectionInterface extends WeightInterface, \Iterator, \Countable
{
  public function append(GatewayInterface $gateway): bool;
}