<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/account/greet", [AccountController::class, "greet"]);
Route::get("/account/login", [AccountController::class, "login"]);
Route::get("/account/edit", [AccountController::class, "edit"]);