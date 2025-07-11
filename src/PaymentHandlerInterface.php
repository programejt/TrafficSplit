<?php

namespace App;

interface PaymentHandlerInterface
{
  public function addPayment(Payment $payment): void;
}