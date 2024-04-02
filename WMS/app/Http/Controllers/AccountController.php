<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function greet() {
        return "Hello from AccountController";
    }

    public function login() {
        return view('account/login');
    }

    public function edit() {
        return view('account/edit');
    }
}
