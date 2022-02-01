<?php

namespace App\View\Models;

use App\Models\ProductCategory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class ProductViewModel implements Arrayable
{
    public function categories(): Collection
    {
        return ProductCategory::all();
    }

    public function toArray(): array
    {
        return [
            'categories' => $this->categories(),
        ];
    }
}
