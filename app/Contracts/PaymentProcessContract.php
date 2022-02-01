<?php

namespace App\Contracts;

interface PaymentProcessContract
{
    public function pay(): array;
}
