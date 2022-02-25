<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Constants\Roles;
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
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', Roles::ADMIN);
        })->first();

        Product::factory(30)
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
