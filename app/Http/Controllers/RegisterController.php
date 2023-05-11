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
        // Session::flash('username', $request->username);
        // Session::flash('email', $request->email);
        // $request->validate([
        //     'email' => 'required',
        //     'username' => 'required|unique:users',
        //     'password' => 'required',
        // ]);
        // $user = new User([
        //     'email' => '$request->email',
        //     'username' => '$request->username',
        //     'password' => Hash::make($request->username)
        // ]);
        // $user->save();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            // 'role' => $request->role
        ]);

        // Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        // return redirect('register');
        // $user = [
        //     'name' => $request->input('name'),
        //     'username' => $request->input('username'),
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
        // ];

        return redirect('login');
    }
}
