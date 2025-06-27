<?php

use PHPUnit\Framework\TestCase;

final class GatewaysCollectionTest extends TestCase
{
  public function testEmpty(): void
  {
    $this->assertCount(0, new GatewaysCollection);
  }

  public function testAppendNotGateway(): void
  {
    $gateways = new GatewaysCollection;

    $gateways->append(new stdClass);
    $gateways->append(6);

    $this->assertCount(0, $gateways);
  }

  public function testAppendExceedMaxWeight(): void
  {
    $gateways = new GatewaysCollection(
      new Gateway('1', 104),
      new Gateway('2', 104),
    );

    $this->assertCount(1, $gateways);
  }

  public function testSuccess(): void
  {
    $gateways = new GatewaysCollection(
      new Gateway('1', 10),
      new Gateway('2', 20),
      new Gateway('2', 30),
    );

    $this->assertCount(3, $gateways);
  }
}
