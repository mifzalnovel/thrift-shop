<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Location;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class DashboardOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role === 'customer') {
            return redirect('/home');
        } else {
            return view('dashboard.order.order', [
                'orders' => Order::all()->where('total_amount', '>', 0)
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if(auth()->user()->role === 'customer') {
            return redirect('/home');
        } else {
            $userDetail = UserProfile::where('user_id', $order->user_id)->first();
            $locations = Location::all();
            $carts = Cart::where('order_id', $order->id)->get();
            return view('dashboard.order.detail', [
                'order' => $order
            ], compact('userDetail', 'locations', 'carts'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        if(auth()->user()->role === 'customer') {
            return redirect()->route('home');
        } else {
            $userDetail = $order->user->id;
            return view('dashboard.order.edit', [
                'order' => $order
            ], compact('userDetail'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order = Order::findOrFail($order->id);
        $order->status = $request->input('status');
        $order->save();

        return redirect('/dashboard/order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
