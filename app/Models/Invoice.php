<?php

namespace App\Models;

use App\Constants\PaymentStatus;
use App\Models\User;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Invoice extends Model
{
    use HasFactory;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function scopeWhereCustomer(Builder $query): Builder
    {
        return $query->where('customer_id', Auth::id());
    }

    public function getPaymentStatusAttribute(): string
    {
        return (new PaymentStatus)->trans($this->attributes['payment_status']);
    }
}
