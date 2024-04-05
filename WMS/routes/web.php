<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/account/greet", [AccountsController::class, "greet"]);
Route::get('/login', [AccountsController::class, 'login'])->name('login');
Route::post('/account/login', [AccountsController::class, 'loginCheck']);
Route::get("/account/edit", [AccountsController::class, "edit"]);

Route::get("/home", [NavigationController::class, "home"]);

Route::get('/error', function() {
    return view('error');
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('product.update');

