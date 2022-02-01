<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(string $slug): View
    {
        $product = Product::whereSlug($slug)
            ->with([
                'category:id,description',
                'image:images.id,images.content,images.product_id',
            ])
            ->firstOrFail([
                'id',
                'slug',
                'name',
                'description',
                'price',
                'discount',
                'maker',
                'expired_at',
                'stock',
                'category_id',
            ]);

        return view('products.show', compact('product'));
    }
}
