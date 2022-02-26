<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ShoppingCartController;

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
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        require_once __DIR__ . '/admin/users.php';
        require_once __DIR__ . '/admin/products.php';
    });

Route::middleware(['auth', 'role:customer'])
    ->group(function () {
        Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
        Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::delete('cart', [ShoppingCartController::class, 'destroy'])->name('cart.destroy');
        Route::post('cart', [ShoppingCartController::class, 'store'])->name('cart.store');
        Route::get('cart', [ShoppingCartController::class, 'index'])->name('cart.index');
    });

Route::get('products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/', [WelcomeController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
