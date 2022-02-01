<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Str;
use App\Constants\PaymentStatus;
use App\Services\Payments\PaymentProcess;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\ProcessPaymentRequest;
use App\Models\Currency;
use App\Models\User;
use App\Services\Payments\PaymentGatewayFactory;

class PaymentController extends Controller
{
    public function store(ProcessPaymentRequest $request)
    {
        $gateway = PaymentGatewayFactory::make($request->input('gateway'));
        $gateway->auth()
            ->buyer([
                'name' => $request->input('name'),
                'document' => $request->input('document'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
            ])
            ->payment([
                'reference' => Str::random(12),
                'description' => 'Mi pago',
                'total' => Cart::subtotal(),
            ]);

        $payment = new PaymentProcess($gateway);
        $response = $payment->process();

        $invoice = new Invoice();
        $invoice->reference = $response['transaction_id'];
        $invoice->total = str_replace(',', '', Cart::subtotal());
        $invoice->payment_status = PaymentStatus::COMPLETE;
        $invoice->customer()->associate(User::inRandomOrder()->first());
        $invoice->currency()->associate(Currency::where('code', 'USD')->first());
        $invoice->user()->associate(User::inRandomOrder()->first());
        $invoice->save();

        Cart::destroy();

        return redirect('/');
    }
}
