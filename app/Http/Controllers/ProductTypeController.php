<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_types = ProductType::paginate(4);
        return view('pages.inventory.product_type.index', compact('product_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.inventory.product_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ProductType $productType)
    {
        $request->validate([
            'name' => 'required|min:4|string',
        ]);
        $productType::create([
            'name' => $request->name
        ]);
        return redirect()->route('product_types.index')->with('message', 'successfully create ');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductType $productType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
        return redirect()->route('product_types.index')->with('message', 'successfully delete');
    }
}
