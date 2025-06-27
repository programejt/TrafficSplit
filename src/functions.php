<?php

function printSummary(
  string $title,
  GatewaysCollection $gateways,
): void {
  echo $title.":\n";

  foreach ($gateways as $gateway) {
    echo $gateway . " (weight: " . $gateway->weight . ") - load: ".$gateway->getTrafficLoad() . "\n";
  }
}