<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SectorController;
use App\Http\Middleware\ValidateShipmentRequest;

// Troubleshooting
Route::get('/', function () {
    return view('welcome');
});
Route::get('/error', function() {
    return view('error');
});

// Home
Route::get("/home", [NavigationController::class, "home"]);

// Accounts
Route::get("/account/greet", [AccountController::class, "greet"]);
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::post('/account/check', [AccountController::class, 'loginCheck']);
Route::get("/account/edit", [AccountController::class, "edit"]);

// Products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('product.update');
Route::get('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('product.destroy');
Route::delete('/products/{productId}', [ProductController::class, 'deleteConfirmed'])->name('product.deleteConfirmed');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');

// Shipments
Route::get('/shipment/form', [ShipmentController::class, 'insert']);
Route::post('/shipment/form', [ShipmentController::class, 'insert'])->middleware(ValidateShipmentRequest::class);
Route::get('/shipment/index', [ShipmentController::class, 'getAll']);
Route::get('/shipment/index', [ShipmentController::class, 'getAll'])->name('shipment.index');
Route::get('/shipment/product/{id}', [ShipmentController::class, 'shipmentProduct'])->name('shipment.product');


// Stocks
Route::get('/stocks', [StockController::class, 'index'])->name('stock.index');

// Sectors
Route::get('/sectors/{location_id}', [SectorController::class, 'fetchSectors'])->name('sectors');

