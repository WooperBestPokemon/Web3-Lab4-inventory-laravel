<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/products/add", [ApiController::class, "addProduct"])->middleware('auth.basic');

//Route::get("/users", [ApiController::class, "createUser"]);
Route::get("/products", [ApiController::class, "getProducts"])->middleware('auth.basic');
Route::get("/products/{id}", [ApiController::class, "getProduct"])->middleware('auth.basic');

Route::put("/products/{id}", [ApiController::class, "modifyProduct"])->middleware('auth.basic');
Route::put("/products/{id}/{quantity}", [ApiController::class, "modifyQuantity"])->middleware('auth.basic');

Route::delete("/products/{id}", [ApiController::class, "deleteProduct"])->middleware('auth.basic');
