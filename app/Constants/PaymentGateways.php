<?php

namespace App\Constants;

use Illuminate\Contracts\Support\Arrayable;

class PaymentGateways implements Arrayable
{
    public const PAYPAL = 'paypal';
    public const PLACETOPAY = 'placetopay';

    public function toArray(): array
    {
        return [
            self::PAYPAL,
            self::PLACETOPAY,
        ];
    }
}
