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
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Contracts\Session\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userDetail = Auth::user();
        $carts = Cart::where('user_id', $userDetail->id)->get();
        $order = Order::where('user_id', $userDetail->id)->get();
        $locations = Location::all();
        return view('cart', compact('carts', 'order', 'userDetail', 'locations'));
    }
    
    public function checkout()
    {
        $user = Auth::user();
        $userDetail = UserProfile::where('user_id', $user->id)->first();
        $carts = Cart::where('user_id', $user->id)->get();
        $locations = Location::all();
        return view('checkout', compact('locations', 'userDetail', 'carts'));
    }

    public function add(Request $request, $id)
    {      
        // dd($request);   
        if($request->quantity === null || $request->quantity == 0 || $request->quantity <= 0  ) {
            return redirect()->back()->with('error', 'Please input quantity');
        } else {
            $user = Auth::user();
            $product = Product::find($id);
            $order = Order::where('user_id', $user->id)->first();
            $cart = Cart::where('user_id', $user->id)->first();
            $total = 0;
            $shipping = 50000;
            if($order === null || $order->status != "pending") {
                $total = $product->price * $request->quantity + $shipping;
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
    
            if(!$cart) {
                $total += $product->price * $request->quantity;
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
                return redirect()->back()->with('success', 'Add Product Successfully');
            } 
    
            if(isset($cart->product_id) && $cart->product_id == $id) {
                $cart->quantity = $request->quantity;
                $cart->price = $product->price;
                $cart->save();
                $total += $cart->price * $cart->quantity;
                Order::where('user_id', $user->id)->update([
                    'total_amount' => $total,
                ]);
                return redirect()->back()->with('success', 'Add Product Successfully');
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
            $total += $cart->price * $cart->quantity;
            Order::where('user_id', $user->id)->update([
                'total_amount' => $total,
            ]);
    
            return redirect()->back()->with('success', 'Add Product Successfully');  
        }
    }

    public function update(Request $request, Cart $cart)
    {
        dd($cart);
        $user = Auth::user();
        $product = Product::find($id);
        $cart = Cart::where('user_id', $user->id)->first();
        $order = Order::where('user_id', $user->id)->first();
        if($request->id and $request->quantity)
        {
            $cart->quantity = $request->quantity;
            $cart->price *= $cart->quantity;
            $cart->save();
            // $ += $cart->price;
            Order::where('user_id', $user->id)->update([
                'total_amount' => $total,
            ]);
            return redirect()->back();
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
            return redirect()->back()->with('success', 'Checkout Successful');
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
        return redirect()->back()->with('success', 'Checkout Successful');
    }

    public function updateDetailChekcout(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $userDetail = UserProfile::where('user_id', $user->id)->first();

        $userDetail->update([
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'location' => $request->location,
            'sname' => $request->sname,
            'semail' => $request->semail,
            'scity' => $request->scity,
            'saddress' => $request->saddress,
            'szip_code' => $request->szip_code,
            'slocation' => $request->slocation,
        ]);
        $userDetail->save();

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => 0,
            'status' => 'pending',
        ]);
        $order->save();

        return redirect('/product')->with('success', 'Checkout Successful');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $total = Order::where('user_id', $cart->user_id)->first();
        $total->total_amount -= $cart->price * $cart->quantity;
        $total->save();
        Cart::destroy($cart->id);
        return redirect('/cart');
    }
}
