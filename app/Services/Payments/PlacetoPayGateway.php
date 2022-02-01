<?php

namespace App\Services\Payments;

use Illuminate\Support\Str;
use App\Contracts\PaymentProcessContract;

class PlacetoPayGateway extends PaymentGateway implements PaymentProcessContract
{
    public function auth(): self
    {
        $this->data['auth'] = [
            'secret_key' => base64_encode(config('payments.gateways.placetopay')),
        ];

        return $this;
    }

    public function pay(): array
    {
        // Envío los datos $this->data;

        return [
            'status' => 200,
            'transaction_id' => Str::random(16),
        ];
    }
}
