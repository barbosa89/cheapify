<?php

namespace App\Contracts;

interface PaymentgatewayContract
{
    public function buyer(array $data): self;
    public function auth(): self;
    public function payment(array $data): self;
    public function getData(): array;
}
