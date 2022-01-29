<?php

namespace App\Models;

use App\Models\User;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
