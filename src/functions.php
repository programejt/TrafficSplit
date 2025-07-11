<?php

function printSummary(
  string $title,
  App\GatewaysCollection $gateways,
): void {
  echo $title.":\n";

  foreach ($gateways as $gateway) {
    echo $gateway . " (weight: " . $gateway->getWeight() . ") - load: ".$gateway->getTrafficLoad() . "\n";
  }
}