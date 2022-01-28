<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Support\Str;
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
        $description = $this->faker->sentence(3);

        return [
            'description' => $description,
            'slug' => Str::slug($description),
            'price' => $this->faker->randomNumber(5),
            'stock' => $this->faker->numberBetween(5, 20),
            // 'category_id' => ProductCategory::factory()->create(),
            // 'user_id' => User::factory()->create(),
        ];
    }
}
