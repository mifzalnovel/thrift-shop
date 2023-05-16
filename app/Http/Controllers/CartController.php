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

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userDetail = Auth::user();
        $order = Order::where('user_id', $userDetail->id)->latest()->first();
        if($order !== null) {
            if($order->id > 1){
                $lastOrderid = $order->id - 1;
                $lastOrder = Order::where('id', $lastOrderid)->first();
                if ($lastOrder->status != "pending") {
                    Cart::create([
                        'user_id' => $userDetail->id,
                        'order_id' => $order->id,
                        'product_id' => 1,
                        'name' => 'Customer',
                        'price' => 0,
                        'quantity' => 0
                    ]);
                }
            }

            $carts = Cart::where('order_id', $order->id)->where('product_id', '!=', 1)->get();
        } else {
            $carts = Cart::where('user_id', $userDetail->id)->get();
        }

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
            $order = Order::where('id', $request->order_id)->latest()->first();
            // $shipping = 50000;
            $total = 50000;

            $dumpCart = Cart::where('user_id', $user->id)->where('product_id', 1)->first();
            if($dumpCart) {
                Cart::destroy($dumpCart->id);
            }

            if ($order) {
                $intOrderid = intval($order->id);
                if($intOrderid > 1){
                    $lastOrderid = $intOrderid - 1;
                    $lastOrder = Order::where('id', $lastOrderid)->first();
                    
                    if($order->status == "pending" && $order->total_amount == 0) {
                        // $total = 50000;
                        $total += ($product->price * $request->quantity);
                        $order = Order::create([
                            'user_id' => $user->id,
                            'total_amount' => $total,
                            'status' => 'pending',
                        ]);
                        $order->save();

                        $order = Order::where('user_id', $user->id)->latest()->first();

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
                    $total = $order->total_amount;
                    
                    $cart = Cart::where('order_id', $request->order_id)->first();
                    if(isset($cart->product_id) && $cart->product_id == $request->id) {
                        $total -= $cart->price * $cart->quantity;
                        $cart->quantity += $request->quantity;
                        $cart->save();
                        $total += $cart->price * $cart->quantity;
                        Order::where('id', $request->order_id)->update([
                            'total_amount' => $total,
                        ]);
                        return redirect()->back()->with('success', 'Update Product Successfully');
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
                    Order::where('id', $request->order_id)->update([
                        'total_amount' => $total,
                    ]);
            
                    return redirect()->back()->with('success', 'Add Product Successfully');  
                }  elseif($intOrderid == 1) {
                    $total = $order->total_amount;
                    // $total += $product->price * $request->quantity;
                    $cart = Cart::where('order_id', $order->id)->first();
                    if(isset($cart->product_id) && $cart->product_id == $id) {
                        $total -= $cart->price * $cart->quantity;
                        $cart->quantity += $request->quantity;
                        $cart->save();
                        $total += $cart->price * $cart->quantity;
                        Order::where('user_id', $user->id)->update([
                            'total_amount' => $total,
                        ]);
                        return redirect()->back()->with('success', 'Update Product Successfully');
                    }   
                    // add new product
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
                    Order::where('id', $request->order_id)->update([
                        'total_amount' => $total,
                    ]);
                    
                    return redirect()->back()->with('success', 'Add Product Successfully');
                }          
            }
            
            if($order === null) {
                $total += $product->price * $request->quantity;
                $order = Order::create([
                    'user_id' => $user->id,
                    'total_amount' => $total,
                    'status' => 'pending',
                ]);
                $order->save();
                // $cart = Cart::where('order_id', $order->id)->first();

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

            
        }
    }

    public function update(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        $cart = Cart::where('order_id', $request->order_id)->where('product_id', $request->product_id)->first();
        $order = Order::where('id', $request->order_id)->where('user_id', $user->id)->first();
        $total = $order->total_amount;
        if($request->product_id && $request->quantity)
        {   
            $total -= $request->price * $request->oldquantity;
            $cart->quantity = $request->quantity;
            $cart->save();

            $total += $cart->price * $cart->quantity;
            Order::where('id', $request->order_id)->update([
                'total_amount' => $total,
            ]);

            return redirect()->back()->with('success', 'Update Quantity Product Successfully');
        }
    }

    public function checkoutPost(Request $request)
    {
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
            'status' => 'pending'
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
