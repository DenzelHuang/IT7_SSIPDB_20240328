<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function greet() {
        return "Hello from AccountsController";
    }

    public function login() {
        return view('account/login');
    }

    public function edit() {
        return view('account/edit');
    }

    public function loginCheck(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $account = Accounts::where('username', $username)->first();

        if ($account && $password === $account->password) {
            // The username and password match, you can authenticate the user here
            return view('home');
        } else {
            // The username or password do not match
            return view('error');
        }
    }
}
