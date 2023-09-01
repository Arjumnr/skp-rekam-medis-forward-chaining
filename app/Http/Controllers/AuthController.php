<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');
        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Username or password is wrong');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
