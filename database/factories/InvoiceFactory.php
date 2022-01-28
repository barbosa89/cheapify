<?php

namespace Database\Factories;

use App\Constants\PaymentStatus;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomNumber(5),
            'payment_status' => $this->faker->randomElement((new PaymentStatus)->toArray())
            // 'user_id' => User::factory()->create(),
            // 'customer_id' => User::factory()->create(),
            // 'currency_id' => Currency::factory()->create(),
        ];
    }
}
