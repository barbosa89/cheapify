<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');

Route::get('users', [UserController::class, 'index'])->name('users.index');
