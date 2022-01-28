<?php

namespace App\Constants;

use App\Contracts\DictionaryContract;
use App\Contracts\TranslateContract;
use Illuminate\Contracts\Support\Arrayable;

class PaymentStatus implements Arrayable, TranslateContract, DictionaryContract
{
    public const PENDING = 'pending';
    public const COMPLETE = 'complete';

    public function toArray(): array
    {
        return [
            self::PENDING,
            self::COMPLETE,
        ];
    }

    public function toDictionary(): array
    {
        return [
            self::PENDING => trans('invoices.payments.pending'),
            self::COMPLETE => trans('invoices.payments.complete'),
        ];
    }

    public function trans(string $key): string
    {
        $items = $this->toDictionary();

        return $items[$key] ?? $key;
    }
}
