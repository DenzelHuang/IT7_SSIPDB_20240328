<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/greet", [AccountController::class, "greet"]);

Route::get("/login", [AccountController::class, "login"]);

Route::get("/accounts", [AccountController::class, "accounts"]);