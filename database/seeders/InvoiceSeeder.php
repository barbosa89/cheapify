<?php

namespace Database\Seeders;

use App\Constants\PaymentStatus;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::factory()
            ->count(20)
            ->make()
            ->each(function (Invoice $invoice) {
                $customer = User::inRandomOrder()->first();

                $user = User::where('id', '!=', $customer->id)
                    ->inRandomOrder()
                    ->first();

                $products = Product::where('user_id', $user->id)
                    ->limit(3)
                    ->get();

                $data = [];

                foreach ($products as $product) {
                    $quantity = random_int(2, 6);

                    $data[$product->id] = [
                        'quantity' => $quantity,
                        'price' => (float) $product->price,
                        'subtotal' => (float) $product->price * $quantity,
                    ];
                }

                $currency = Currency::inRandomOrder()->first();

                $paymentStatus = (new PaymentStatus())->toArray();

                $invoice->total = collect(array_values($data))->sum('subtotal');
                $invoice->payment_status = $paymentStatus[random_int(0, 1)];
                $invoice->customer()->associate($customer);
                $invoice->user()->associate($user);
                $invoice->currency()->associate($currency);
                $invoice->save();

                $invoice->products()->attach($data);
            });
    }
}
