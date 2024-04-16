<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function login() {
        return view('account/login');
    }

    public function index() {
        $accounts = Account::all();
        return view('account/index', [
            "accounts" => $accounts,
        ]);
    }

    public function edit($id) {
        $account = Account::find($id);
        return view('account.edit', compact('account'));
    }

    
    public function form() {        
        return view('account/accountForm');
    }

    public function loginCheck(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $account = Account::where('username', $username)->first();

        if ($account && $password === $account->password) {
            // The username and password match, you can authenticate the user here
            return redirect('/home');
        } else {
            // The username or password do not match
            return view('error');
        }
    }
}
