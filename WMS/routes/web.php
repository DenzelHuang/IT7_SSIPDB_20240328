<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('app');
});

Route::get("/greet", [AccountController::class, "greet"]);

Route::get("/login", [AccountController::class, "login"]);

Route::get("/register", [AccountController::class, "register"]);