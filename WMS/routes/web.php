<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipmentController;

// Troubleshooting
Route::get('/', function () {
    return view('welcome');
});
Route::get('/error', function() {
    return view('error');
});

// Home
Route::get("/home", [NavigationController::class, "home"])->name('home');;

// Accounts
Route::get("/account/greet", [AccountController::class, "greet"]);
Route::get('/login', [AccountController::class, 'login'])->name('account.login');
Route::post('/account/check', [AccountController::class, 'loginCheck']);
Route::get("/account/edit", [AccountController::class, "edit"])->name('account.edit');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('product.update');

// Shipments
Route::get('/shipment/form', [ShipmentController::class, 'insert'])->name('shipment.form');;
Route::get('sectors/{location_id}', [App\Http\Controllers\SectorController::class, 'getRelatedSectors'])->name('sectors.related');