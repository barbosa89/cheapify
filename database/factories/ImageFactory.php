<?php

namespace Database\Factories;

use App\Constants\ImageData;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->getEncodedImage(),
            // 'product_id' => Product::factory()->create(),
        ];
    }

    private function getEncodedImage(): string
    {
        $image = (string) Image::make($this->faker->image())->encode('data-url');

        return str_replace(ImageData::PNG, '', $image);
    }
}
