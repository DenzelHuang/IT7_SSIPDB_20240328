<?php

use App\Http\Middleware\ValidateAccount;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SectorController;
use App\Http\Middleware\ValidateShipmentRequest;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\MonitoringController;
use App\Http\Middleware\AuthenticateUser;

// Troubleshooting
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/error', function() {
    return view('error');
});

Route::get('/', [AccountController::class, 'login'])->name('login');
Route::post('/account/check', [AccountController::class, 'loginCheck']);
Route::get('/logout', [AccountController::class, 'logout']);

Route::middleware(AuthenticateUser::class)->group(function () {
    // Home
    // Route::get("/home", [NavigationController::class, "home"]);
    Route::get('/home', [ProductController::class, 'getDataForHomePage']);

    // Accounts
    Route::get("/account/index", [AccountController::class, "index"])->name('account.index');
    Route::get("/account/form", [AccountController::class, "form"])->name('account.form');
    Route::post("/account/form", [AccountController::class, "create"])->name('account.create');
    Route::get("/account/edit/{id}", [AccountController::class, "edit"])->name('account.edit');
    Route::post("/account/edit/{id}", [AccountController::class, "save"])->name('account.save');
    Route::get("/account/delete/{id}", [AccountController::class, "delete"])->name('account.delete');
    Route::post("/account/delete/{id}", [AccountController::class, "confirm"])->name('account.confirmDelete');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{productId}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/products/{productId}/delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::delete('/products/{productId}', [ProductController::class, 'deleteConfirmed'])->name('product.deleteConfirmed');
    Route::get('/products/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');

    // Shipments
    Route::get('/shipment/form', [ShipmentController::class, 'insert'])->name('shipment.form');
    Route::post('/shipment/form', [ShipmentController::class, 'insert'])->middleware(ValidateShipmentRequest::class);
    Route::get('/shipment/index', [ShipmentController::class, 'getAll'])->name('shipment.index');
    Route::get('/shipment/product/{id}', [ShipmentController::class, 'shipmentProduct'])->name('shipment.product');


    // Stocks
    Route::get('/stocks', [StockController::class, 'index'])->name('stock.index');

    // Sectors
    Route::get('/sectors/{location_id}', [App\Http\Controllers\SectorController::class, 'fetchSectors'])->name('sectors');
    Route::get('/sectors/{locationId}/add', [SectorController::class, 'create'])->name('sector.create');
    Route::get('/sectors/{locationId}/remove', [SectorController::class, 'delete'])->name('sector.delete');
    Route::post('/sectors/{locationId}', [SectorController::class,'store'])->name('sector.store');
    Route::delete('/sectors/delete', [SectorController::class,'deleteConfirmed'])->name('sector.deleteConfirmed');
    Route::get('/getSectors', [SectorController::class, 'getSectors']);

    //Location
    Route::get('/locations', [LocationController::class, 'index'])->name('location.index');
    Route::get('/locations/create', [LocationController::class, 'create'])->name('location.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('location.store');
    Route::get('locations/{locationId}/edit', [LocationController::class, 'edit'])->name('location.edit');
    Route::put('locations/{locationId}', [LocationController::class, 'update'])->name('location.update');
    Route::get('locations/{locationId}/delete',[LocationController::class, 'delete'])->name('location.delete');
    Route::delete('locations/{locationId}', [LocationController::class, 'deleteConfirmed'])->name('location.deleteConfirmed');

    //Movement
    Route::get('/movement', [MovementController::class, 'index'])->name('movement.index');
    Route::post('/movement', [MovementController::class, 'store'])->name('movement.store');

    //Monitoring
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
});



