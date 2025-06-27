<?php

require 'vendor/autoload.php';
require 'src/functions.php';

const ITERATIONS = 10000;

$equalLoadGateways = new GatewaysCollection(
  new Gateway('Gateway 1', 25),
  new Gateway('Gateway 2', 25),
  new Gateway('Gateway 3', 25),
  new Gateway('Gateway 4', 25),
);

$trafficSplitEqual = new TrafficSplit($equalLoadGateways);

for ($i = 0; $i < ITERATIONS; $i++) {
  $trafficSplitEqual->handlePayment(new Payment($i + 1));
}

printSummary('Summary for equal load', $equalLoadGateways);

$weightedLoadGateways = new GatewaysCollection(
  new Gateway('Gateway 1', 75),
  new Gateway('Gateway 2', 10),
  new Gateway('Gateway 3', 15),
);

$trafficSplitWeighted = new TrafficSplit($weightedLoadGateways);

for ($i = 0; $i < ITERATIONS; $i++) {
  $trafficSplitWeighted->handlePayment(new Payment($i + 1));
}

echo "\n";
printSummary('Summary for splited load', $weightedLoadGateways);
