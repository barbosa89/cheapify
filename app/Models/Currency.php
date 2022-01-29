<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
