<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

Route::post('products', [ProductController::class, 'store'])->name('products.store');

Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

Route::get('products', [ProductController::class, 'index'])->name('products.index');
