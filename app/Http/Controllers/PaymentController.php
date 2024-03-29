<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Currency;
use Illuminate\Support\Str;
use App\Constants\PaymentStatus;
use App\Services\Payments\PaymentProcess;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\ProcessPaymentRequest;
use App\Notifications\ErrorOnCreateInvoice;
use App\Notifications\InvoiceWasCreated;
use App\Services\Payments\PaymentGatewayFactory;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class PaymentController extends Controller
{
    public function store(ProcessPaymentRequest $request)
    {
        DB::beginTransaction();

        try {
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

            $data = [];

            foreach (Cart::content() as $product) {
                $data[$product->id] = [
                    'quantity' => $product->qty,
                    'price' => (float) $product->price,
                    'subtotal' => (float) $product->price * $product->qty,
                ];
            }

            $invoice = new Invoice();
            $invoice->reference = $response['transaction_id'];
            $invoice->total = str_replace(',', '', Cart::subtotal());
            $invoice->payment_status = PaymentStatus::COMPLETE;
            $invoice->customer()->associate(auth()->user());
            $invoice->currency()->associate(Currency::where('code', 'USD')->first());
            $invoice->user()->associate(User::whereIsAdmin()->first());
            $invoice->save();

            $invoice->products()->attach($data);

            Cart::destroy();

            throw new InvalidArgumentException("Parámetros de compra incorrectos");

            DB::commit();

            $invoice->customer->notify(new InvoiceWasCreated($invoice));
            $invoice->user->notify(new InvoiceWasCreated($invoice));

            return redirect()->route('invoices.index');
        } catch (Throwable $th) {
            DB::rollBack();

            $admin = User::whereIsAdmin()->first();
            $admin->notify(new ErrorOnCreateInvoice($th->getMessage()));

            return back()->with('error', $th->getMessage());
        }
    }
}
