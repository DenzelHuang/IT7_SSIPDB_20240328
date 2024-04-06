<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/account/greet", [AccountController::class, "greet"]);
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::post('/account/check', [AccountController::class, 'loginCheck']);
Route::get("/account/edit", [AccountController::class, "edit"]);

Route::get("/home", [NavigationController::class, "home"]);

Route::get('/error', function() {
    return view('error');
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('product.update');

