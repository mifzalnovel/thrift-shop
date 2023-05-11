<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function addItem($productId, $name, $price, $quantity) 
    {
        $cart = Cart::where('product_id', $productId)->first();
        if ($cart) {
            $cart->quantity += $quantity;
            $cart->price *= $cart->quantity;
            $cart->save();
        } else {
            Cart::create([
                'product_id' => $productId,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ]);
        }
    }

    public function removeItem($productId) {
        $cart = Cart::where('product_id', $productId)->first();
        if ($cart) {
            $cart->delete();
        }
    }

    public function updateItem($productId, $quantity) {
        $cart = Cart::where('product_id', $productId)->first();
        if ($cart) {
            $cart->quantity = $quantity;
            $cart->price *= $cart->quantity;
            $cart->save();
        }
    }
}
