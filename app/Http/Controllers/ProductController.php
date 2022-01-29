<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with([
                'image' => function ($query) {
                    $query->select(['images.id', 'images.content', 'images.product_id']);
                },
            ])
            ->withInvoiceCount()
            ->hasManyItems()
            ->paginate();

        return view('products.index', compact('products'));
    }
}
