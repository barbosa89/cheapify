<?php

namespace App\Http\Controllers;

use App\Constants\PaymentGateways;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        $gateways = (new PaymentGateways())->toArray();

        return view('cart', compact('gateways'));
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::whereSlug($request->slug)->firstOrFail();

        Cart::add($product->id, $product->description, 1, $product->price);

        return back();
    }

    public function destroy()
    {
        Cart::destroy();

        return redirect('/');
    }
}
