<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(): View
    {
        $products = Product::inRandomOrder()
            ->with([
                'category:id,description',
                'image:images.id,images.content,images.product_id',
            ])
            ->limit(40)
            ->get([
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

        $product = $products->shift();
        $product->load('images:images.id,images.content,images.product_id');

        return view('welcome', compact('products', 'product'));
    }
}
