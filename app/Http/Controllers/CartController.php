<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Location;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get()->first();
        return view('cart', compact('cart'));
    }
    
    public function checkout()
    {
        $user = Auth::user();
        $userDetail = UserProfile::where('user_id', $user->id)->first();
        $cart = session()->get('cart');
        $locations = Location::all();
        session()->put('cart', $cart);
        return view('checkout', compact('locations', 'userDetail'));
    }

    public function add(Request $request, $id)
    {       
        // dd($request); 
        $user = Auth::user();
        $product = Product::find($id);
        $cart = Cart::where('user_id', $user->id)->first();
        $order = Order::where('user_id', $user->id)->first();
        $total = 0;

        if(!$cart) {
            $total = $product->price * $request->quantity;
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $total,
                'status' => 'pending',
            ]);
            $order->save();

            $cart = Cart::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'product_id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
            ]);
            $cart->save();
            return redirect()->back();
        } 

        if(isset($cart->product_id) && $cart->product_id == $id) {
            $cart->quantity = $request->quantity;
            $cart->price *= $cart->quantity;
            $cart->save();
            $total += $cart->price;
            Order::where('user_id', $user->id)->update([
                'total_amount' => $total,
            ]);
            return redirect()->back();
        }

        $cart = Cart::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'product_id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
        ]);
        $cart->save();
        $total += $cart->price;
        Order::where('user_id', $user->id)->update([
            'total_amount' => $total,
        ]);

        return redirect()->back();  


    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkoutPost(Request $request)
    {
        // $checkcout = new Checkout;
        $cart = session()->get('cart');
        dd($request);
        
        $itemOrdered = session()->get('checkout');

        if(!$itemOrdered) {
            $order = [
                'total_amount' => $request->total,
                'status' => 'pending',
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'zip_code' => $request->zip,
                'location' => $request->location,
                'sname' => $request->sname,
                'semail' => $request->semail,
                'saddress' => $request->saddress,
                'scity' => $request->scity,
                'szip_code' => $request->szip,
                'slocation' => $request->slocation,
            ];

            $orderDB = Order::create($order);
            $orderDB->save();

            foreach ($request->sumQuantity as $item) {
                $product = Product::findOrFail($item['product_id']);
                $order->items()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
            ]);

            $product->decrement('quantity', $item['quantity']);
        }

            session()->put('checkout', $itemOrdered);
            return redirect()->back();
        }

        $order = $itemOrdered->orders()->create([
            'total_amount' => $request->total,
            'status' => 'pending',
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'zip_code' => $request->zip,
            'location' => $request->location,
            'sname' => $request->sname,
            'semail' => $request->semail,
            'saddress' => $request->saddress,
            'scity' => $request->scity,
            'szip_code' => $request->szip,
            'slocation' => $request->slocation,
        ]);

        foreach ($request->sumQuantity as $item) {
            $product = Product::findOrFail($item['product_id']);
            $order->cart()->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);

            $product->decrement('quantity', $item['quantity']);
        }

        session()->put('checkout', $itemOrdered);
        return redirect()->back();

        // return redirect()->route('home');

        // $checkout = new Checkout;
        // $checkout->name = $request->input('name');
        // $checkout->email = $request->input('email');
        // $checkout->address = $request->input('address');
        // $checkout->city = $request->input('city');
        // $checkout->state = $request->input('state');
        // $checkout->zip = $request->input('zip');
        // $checkout->save();

        // return redirect()->back()->with('success', 'Your order has been placed!');
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
//     public function store(Request $request)
// {
//     // $user = auth()->user();
//     $cart = new Cart();
//     $cart->user_id = 1;
//     $cart->product_id = $request->product_id;
//     $cart->quantity = $request->quantity;
//     $cart->save();

//     return redirect()->back()->with('success', 'Product added to cart.');
// }


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateCartRequest $request, Cart $cart)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
