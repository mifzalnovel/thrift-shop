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
        $products = Cart::all()->sortByDesc('quantity')->take(5);
        // $products = Product::all()->sortByDesc('created_at')->take(5);
        // $products = collect($products)->count;
        // $products = $products->sortByDesc('');
        $users = User::all()->take(5);
        return view('dashboard.dashboard', compact('products', 'users'));
    }
}
