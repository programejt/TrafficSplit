<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\GatewaysCollection;
use App\Gateway;

final class GatewaysCollectionTest extends TestCase
{
  public function testEmpty(): void
  {
    $this->assertCount(0, new GatewaysCollection);
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
