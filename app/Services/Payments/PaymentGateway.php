<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayContract;

abstract class PaymentGateway implements PaymentGatewayContract
{
    private array $data;

    public function __construct()
    {
        $this->data = [
            'buyer' => [],
            'auth' => [],
            'payment' => [],
        ];
    }

    abstract public function auth(): self;

    public function buyer(array $data): self
    {
        $this->data['buyer'] = [
            'name' => $data['name'],
            'document' => $data['document'],
            'email' => $data['email'],
            'address' => $data['address'],
        ];

        return $this;
    }

    public function payment(array $data): self
    {
        $this->data['payment'] = [
            'reference' => $data['reference'],
            'description' => $data['description'],
            'amount' => [
                'currency' => 'USD',
                'total' => $data['total'],
            ]
        ];

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
