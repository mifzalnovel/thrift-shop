<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    
    public function actionregister(Request $request)
    {
        $validatedData = $request->validate([
            'name' =>'required',
            'email' =>'required|email:dns|unique:users',
            'username' =>'required|unique:users',
            'password' =>'required|min:6'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('login')->with('success', 'Registration Successfull! Please Login!');
    }
}
