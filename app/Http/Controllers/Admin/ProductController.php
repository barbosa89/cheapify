<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with([
                'image' => function ($query) {
                    $query->select(['images.id', 'images.content', 'images.product_id']);
                },
            ])
            ->paginate();

        return view('admin.products.index', compact('products'));
    }
}
