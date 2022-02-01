<?php

namespace App\Actions;

use App\Contracts\ActionContract;
use App\Models\Product;

class StoreProductAction implements ActionContract
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function execute(): Product
    {
        $product = new Product();
        $product->name = $this->data['name'];
        $product->description = $this->data['description'];
        $product->price = $this->data['price'];
        $product->discount = $this->parseDiscount();
        $product->maker = json_encode($this->data['maker']);
        $product->stock = $this->data['stock'];
        $product->category()->associate($this->data['category_id']);
        $product->user()->associate($this->data['user_id']);
        $product->save();

        return $product;
    }

    public function parseDiscount(): float
    {
        return ($this->data['discount'] ?? 0) / 100;
    }
}
