<?php

namespace App\Http\Controllers\Admin;

use App\Actions\StoreProductAction;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\View\Models\ProductViewModel;
use Illuminate\Http\RedirectResponse;

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

    public function create(): View
    {
        return view('admin.products.create', new ProductViewModel());
    }

    public function store(StoreProduct $request): RedirectResponse
    {
        $action = new StoreProductAction($request->validated());

        $action->execute();

        return redirect()->route('admin.products.index');
    }
}
