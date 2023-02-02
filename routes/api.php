<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Routes for users
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/users', [AuthController::class, 'index']);
Route::delete('/delete-user/{id}', [AuthController::class, 'destroy']);

//Routes for products
Route::get('products', [ProductController::class, 'index']);
Route::post('store-product', [ProductController::class, 'store']);
Route::put('update-product/{id}', [ProductController::class, 'update']);
Route::delete('delete-product/{id}', [ProductController::class, 'destroy']);

//Routes for suppliers
Route::get('suppliers', [SupplierController::class, 'index']);
Route::post('store-supplier', [SupplierController::class, 'store']);
Route::put('update-supplier/{id}', [SupplierController::class, 'update']);
Route::delete('delete-supplier/{id}', [SupplierController::class, 'index']);
