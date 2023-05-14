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
        $users = User::all();
        $Orders = Order::all();
        $products = Product::all(); 
        return view('dashboard.report', [
            'users' => $users,
            'orders' => $Orders,
            'products' => $products
        ]);
    }
}
