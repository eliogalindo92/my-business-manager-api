<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\supplier;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::with(['products'])->get();
        return response()->json($suppliers, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());
        $supplier->products()->sync($request->input('products'));
        return response()->json(["message"=>"Supplier created successfully"], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatedSupplier = $request->validate(
            [
                'code' => 'required|string|max:64',
                'name' => 'required|string',
                'phone_number' => 'required|numeric|max_digits:8',
                'address' => 'required|string'
            ]);
        $supplier = Supplier::find($id);
        $supplier->update($updatedSupplier);
        return response()->json(["message"=>"Supplier updated successfully"],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->destroy($id);
        return response()->json(["message"=>"Supplier deleted successfully"],Response::HTTP_OK);
    }
}
