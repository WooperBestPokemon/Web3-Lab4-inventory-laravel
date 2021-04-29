<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AddController extends Controller
{
    //
    function index()
    {
        return view('add');
    }
    function addProduct(Request $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->provider = $request->provider;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->image = $request->imageLink;

        $product->save();

        //return the user to the list, so he can see his/her new product
        return view('list',  ['products' => Product::all()]);
    }
}
