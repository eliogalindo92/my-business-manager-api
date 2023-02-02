<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['suppliers'])->get();
        return response()->json($products, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        $product->suppliers()->sync($request->input('supplier'));
        return response()->json(["message"=>"Product created successfully"], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $updatedProduct = $request->validate(
        [
            'code' => 'required|string|max:64',
            'name' => 'required|string',
            'type' => 'required|string',
            'cost' => 'required|numeric',
            'measurement_unit' => 'required|string',
            'supplier' => 'required|integer'
        ]);
        $product = Product::find($id);
        $product -> update($updatedProduct);
        $product->suppliers()->sync($request->input('supplier'));
        return response()->json(["message"=>"Product updated successfully"], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->destroy($id);
        return response()->json(["message"=>"Product deleted successfully"], Response::HTTP_OK);
    }
}
