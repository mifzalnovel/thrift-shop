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
        return view('dashboard.order', [
            'orders' => Order::all()
        ]);
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
        $userDetail = UserProfile::where('user_id', $order->user_id)->first();
        $locations = Location::all();
        $carts = Cart::where('order_id', $order->id)->get();
        return view('dashboard.order.detail', [
            'order' => $order
        ], compact('userDetail', 'locations', 'carts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $userDetail = $order->user->id;
        return view('dashboard.order.edit', [
            'order' => $order
        ], compact('userDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order = Order::findOrFail($order->id);
        $order->status = $request->input('status');
        // dd($order->status);
        $order->save();
        // return response()->json($shipping);

        // $rules = [
        //     'status' => 'required|in:PENDING,SHIPPING,SUCCESS,FAILED,CANCELLED'
        // ];

        // $validatedData = $request->validate($rules);

        // Order::where('id', $order->id)
        //     ->update($validatedData);

        // $order->update($validatedData);

        return redirect('/dashboard/order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
