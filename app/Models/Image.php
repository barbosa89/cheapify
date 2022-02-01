<?php

namespace App\Models;

use App\Models\Product;
use App\Constants\ImageData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getContentAttribute(): string
    {
        return ImageData::PNG . $this->attributes['content'];
    }
}
