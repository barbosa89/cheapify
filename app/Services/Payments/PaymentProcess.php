<?php

namespace App\Services\Payments;

use App\Contracts\PaymentProcessContract;

class PaymentProcess
{
    private PaymentProcessContract $gateway;

    public function __construct(PaymentProcessContract $gateway)
    {
        $this->gateway = $gateway;
    }

    public function process(): array
    {
        return $this->gateway->pay();
    }
}
