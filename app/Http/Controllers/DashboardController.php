<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->role === 'customer') {
            return redirect()->route('home');
        } else {
            $products = Cart::all()->sortByDesc('created_at')->take(5);
            $users = User::all()->take(5);
            return view('dashboard.dashboard', compact('products', 'users'));
        }
    }
}
