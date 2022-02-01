<?php

namespace App\Services\Payments;

use App\Constants\PaymentGateways;
use App\Contracts\PaymentProcessContract;
use App\Services\Payments\PaypalGateway;
use App\Services\Payments\PlacetoPayGateway;

class PaymentGatewayFactory
{
    public static function make(string $gateway): PaymentProcessContract
    {
        if ($gateway === PaymentGateways::PAYPAL) {
            return new PaypalGateway();
        }

        return new PlacetoPayGateway();
    }
}
