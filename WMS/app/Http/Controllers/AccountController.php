<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login() {
        return view('account/login');
    }

    public function index() {
        $users = User::all();
        return view('account/index', [
            "users" => $users,
        ]);
    }

    public function form() {
        return view('account/accountForm');
    }

    public function edit($id) {
        $user = User::where('id', $id)->firstOrFail();
        return view('account/accountEdit', compact('user'));
    }
    
    public function save(Request $request, $id) {
        $user = User::where('id', $id)->firstOrFail();
        $passwordCurrent = $user->password;
        $user->timestamps = false;
        $username = $request->input('username');
        $password = $request->input('password');
        $newPassword = $request->input('new_password');

        // Check if username already exists
        if (strcasecmp(trim($username), trim($user->username)) !== 0) {
            $existingUsername = User::where('username', 'LIKE', $username)->first();
            if ($existingUsername) {
                return redirect()->back()->withErrors('Username already exists');
            }
        }
        
    
        if ($user && Hash::check($password, $passwordCurrent)) {
            // The old password matches, update the username and password
            $user->username = $username;
            if (!empty($newPassword)) {
                $user->password = bcrypt($newPassword);
            }
            $user->save();
            return redirect()->route('account.index');
        } else {
            // The old password does not match
            return redirect()->back()->withErrors('Current password does not match');
        }    
    }    

    public function delete($id) {
        $user = User::where('id', $id)->firstOrFail();
        return view('account/accountDelete', compact('account'));
    }

    public function confirm(Request $request, $id) {
        $user = User::where('id', $id)->firstOrFail();
        $password = $request->input('password');
    
        if (Hash::check($password, $user->password)) {
            // The password matches, proceed to delete the account
            $user->delete();
            return redirect()->route('account.index')->with('success', 'User deleted successfully');
        } else {
            // The password does not match
            return redirect()->back()->withErrors('Password does not match');
        }
    }    

    public function create(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
    
        // Creating a new account
        $user = new User();
        $user->timestamps = false;
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->save();
    
        return redirect()->route('account.index')->with('success', 'Account created successfully');
    }
    

    public function loginCheck(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // The username and password match, you can authenticate the user here
            return redirect('/home');
        } else {
            // The username or password do not match
            return redirect()->back()->withErrors(['msg' => 'Incorrect username or password']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}