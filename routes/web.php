<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        require_once __DIR__ . '/admin/products.php';
    });

Route::post('pay', [PaymentController::class, 'store'])->name('payments.store')
;
Route::delete('cart', [ShoppingCartController::class, 'destroy'])->name('cart.destroy');
Route::post('cart', [ShoppingCartController::class, 'store'])->name('cart.store');
Route::get('cart', [ShoppingCartController::class, 'index'])->name('cart.index');

Route::get('products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/', [WelcomeController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
