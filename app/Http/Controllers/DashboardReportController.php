<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardReportController extends Controller
{
    public function index()
    {
        if(auth()->user()->role === 'customer') {
            return redirect()->route('home');
        } else {
            $users = User::all();
            $orders = Order::all();
            $products = Product::all(); 
            return view('dashboard.report', [
                'users' => $users,
                'orders' => $orders,
                'products' => $products
            ]);
        }
    }
}
