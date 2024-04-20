<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function form() {
        return view('account/accountForm');
    }

    public function edit($id) {
        $account = Account::where('user_id', $id)->firstOrFail();
        return view('account/accountEdit', compact('account'));
    }
    
    public function save(Request $request, $user_id) {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        $username = $request->input('username');
        $password = $request->input('password');
    
        $account = Account::where('user_id', $user_id)->firstOrFail();
        $account->timestamps = false;
        $account->username = $username;
        $account->password = bcrypt($password);
        $account->save();
    
        return redirect()->route('account.index');
    }

    public function delete($id) {
        $account = Account::where('user_id', $id)->firstOrFail();
        return view('account/accountDelete', compact('account'));
    }

    public function confirm(Request $request, $id) {
        $account = Account::where('user_id', $id)->firstOrFail();
        $account->delete();
        return redirect()->route('account.index')->with('success', 'Account deleted successfully');
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        $username = $request->input('username');
        $password = $request->input('password');
    
        // Creating a new account
        $account = new Account();
        $account->timestamps = false;
        $account->username = $username;
        $account->password = bcrypt($password);
        $account->save();
    
        return redirect()->route('account.index')->with('success', 'Account created successfully');
    }
    

    public function loginCheck(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $account = Account::where('username', $username)->first();

        if ($account && Hash::check($password, $account->password)) {
            // The username and password match, you can authenticate the user here
            return redirect('/home');
        } else {
            // The username or password do not match
            return redirect()->back()->withErrors(['msg' => 'Incorrect username or password']);
        }
    }
}