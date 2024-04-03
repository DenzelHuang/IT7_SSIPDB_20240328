<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NavigationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/account/greet", [AccountController::class, "greet"]);
Route::get("/account/login", [AccountController::class, "login"]);
Route::get("/account/edit", [AccountController::class, "edit"]);

Route::get("/home", [NavigationController::class, "home"]);