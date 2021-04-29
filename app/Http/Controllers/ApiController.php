<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function MongoDB\BSON\toJSON;

class ApiController extends Controller
{
    //
    function addProduct(Request $request)
    {
        $name = $request->name;
        $provider = $request->provider;
        $price = $request->price;
        $quantity = $request->quantity;
        $description = $request->description;
        $image = $request->image;

        $answer = "The item $name was added successfully";

        if($name != "" && $provider != "" && $price != "" && $quantity != "" && $description != "" && $image != "") {

            if(is_double($price) && is_integer($quantity)){

                $product = new Product;

                $product->name = $name;
                $product->provider = $provider;
                $product->price = $price;
                $product->quantity = $quantity;
                $product->description = $description;
                $product->image = $image;

                $product->save();
            }
            else{
                $answer = "Error : Price or quantity isn't a number";
            }
        }
        else{
            $answer = "Error : Some value(s) are empty";
        }

        return response()->json(['message' => $answer]);
    }
    function getProducts()
    {
        $products = Product::all();

        $tempArray = [];

        foreach($products as $product){
            $tempArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                "link" => url("localhost/lab4/public/api/products/$product->id")
            ];
        }

        return response()->json($tempArray);
    }
    function getProduct($id)
    {
        $product = Product::find($id);

        $name = $product->name;
        $provider = $product->provider;
        $price = $product->price;
        $quantity = $product->quantity;
        $description = $product->description;
        $image = $product->image;

        $json = ['id' => $id,'name' => $name, 'provider' => $provider, 'price' => $price, 'quantity' => $quantity, 'description' => $description, 'image' => $image];

        return response()->json($json);
    }
    function modifyProduct($id, Request $request)
    {
        $name = $request->name;
        $provider = $request->provider;
        $price = $request->price;
        $quantity = $request->quantity;
        $description = $request->description;
        $image = $request->image;

        $answer = "The item $name was modified successfully";

        if($name != "" && $provider != "" && $price != "" && $quantity != "" && $description != "" && $image != "") {

            if(is_double($price) && is_integer($quantity)){

                $product = Product::find($request->id);

                $product->name = $name;
                $product->provider = $provider;
                $product->price = $price;
                $product->quantity = $quantity;
                $product->description = $description;
                $product->image = $image;

                $product->save();
            }
            else{
                $answer = "Error : Price or/and quantity isn't a number";
            }
        }
        else{
            $answer = "Error : Some value(s) are empty";
        }
        return response()->json(['message' => $answer]);
    }
    function modifyQuantity($id, $quantity)
    {
        $answer = "The item N.$id was modified successfully";

        $product = Product::find($id);
        $product->quantity = $quantity;
        $product->save();

        return response()->json(['message' => $answer]);
    }
    function deleteProduct($id)
    {
        DB::table('products')->delete($id);

        return response()->json(["message" => "deleted successfully"]);
    }
    function createUser(){
        $user = new User();

        $user->name = 'pikachu';
        $user->password = Hash::make('pokemon');
        $user->email = 'kurby@live.ca';
        $user->save();
    }
}
