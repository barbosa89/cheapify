<?php

namespace Tests\Feature\Admin;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_see_the_form_to_create_products()
    {
        $category = ProductCategory::factory()->create();

        $response = $this->get(route('admin.products.create'));

        $response->assertOk()
            ->assertViewIs('admin.products.create')

            ->assertViewHas('categories', function ($data) use ($category) {
                return $data->first()->id === $category->id;
            });
    }

    /**
     * @test
     */
    public function user_can_store_new_product()
    {
        $user = User::factory()->create();
        $category = ProductCategory::factory()->create();

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(4),
            'price' => $this->faker->numberBetween(100, 200),
            'maker' => [
                'company' => $this->faker->company,
                'country' => $this->faker->country,
            ],
            'stock' => $this->faker->numberBetween(1, 10),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ];

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionDoesntHaveErrors()
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => $data['name'],
            'category_id' => $data['category_id'],
        ]);
    }
}
