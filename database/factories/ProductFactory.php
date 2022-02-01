<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomNumber(5),
            'stock' => $this->faker->numberBetween(5, 20),
            'maker' => json_encode([
                'company' => $this->faker->company,
                'country' => $this->faker->country,
            ]),
            'expired_at' => now()->addYear(),
            // 'category_id' => ProductCategory::factory()->create(),
            // 'user_id' => User::factory()->create(),
        ];
    }
}
