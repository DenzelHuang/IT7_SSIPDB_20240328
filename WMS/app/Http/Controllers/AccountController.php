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
        $account = Account::where('user_id', $user_id)->firstOrFail();
        $passwordOld = $account->password;
        $account->timestamps = false;
        $username = $request->input('username');
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
    
        if ($account && Hash::check($oldPassword, $passwordOld)) {
            // The old password matches, update the username and password
            $account->username = $username;
            $account->password = bcrypt($newPassword);
            $account->save();
            return redirect()->route('account.index');
        } else {
            // The old password does not match
            return redirect()->back()->withErrors('Old password does not match');
        }    
    }    

    public function delete($id) {
        $account = Account::where('user_id', $id)->firstOrFail();
        return view('account/accountDelete', compact('account'));
    }

    public function confirm(Request $request, $id) {
        $account = Account::where('user_id', $id)->firstOrFail();
        $password = $request->input('password');
    
        if (Hash::check($password, $account->password)) {
            // The password matches, proceed to delete the account
            $account->delete();
            return redirect()->route('account.index')->with('success', 'Account deleted successfully');
        } else {
            // The password does not match
            return redirect()->back()->withErrors('Password does not match');
        }
    }    

    public function create(Request $request) {
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