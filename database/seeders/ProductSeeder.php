<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first();

        Product::factory()
            ->count(10)
            ->make()
            ->each(function (Product $product) use ($user) {
                $product->user()->associate($user);
                $product->category()->associate(ProductCategory::inRandomOrder()->first());
                $product->save();

                $images = Image::factory()->count(2)->make([
                    'product_id' => $product->id,
                ]);

                $product->images()->saveMany($images);
            });
    }
}
