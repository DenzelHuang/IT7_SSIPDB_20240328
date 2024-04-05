<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\NavigationController;

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