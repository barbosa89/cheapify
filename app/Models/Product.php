<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Invoice;
use App\Constants\ImageData;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['title'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class)->oldestOfMany();
    }

    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class);
    }

    public function getImageContent(): string
    {
        return ImageData::PNG . $this->image->content;
    }

    public function getTitleAttribute(): string
    {
        return strtoupper($this->attributes['description']);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtolower($value);
    }

    public function scopeWithInvoiceCount(Builder $query): Builder
    {
        return $query->withCount('invoices');
    }

    public function scopeHasManyItems(Builder $query): Builder
    {
        return $query->where('stock', '>=', 10);
    }
}
