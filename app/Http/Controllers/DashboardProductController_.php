<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    public function index()
    {
        return view('dashboard.product');
    }

    public function create()
    {
        return view('dashboard.product.create');
    }

    public function store(Request $request)
    {
        dd($request);

        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required|numeric',
        //     'description' => 'required',
        //     'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        // ]);

        // // $imageName = time() . '.' . $request->image->extension();
        // // $request->image->move(public_path('images'), $imageName);

        // $imageName = time() . '.' . $request->image->extension();
        // $request->image->move(public_path('images'), $imageName);

        // $product = new Product;
        // $product->name = $request->name;
        // $product->price = $request->price;
        // $product->description = $request->description;
        
        // $product->image = $imageName;
        // $product->save();
    }

}
