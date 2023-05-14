<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'carts';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
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
