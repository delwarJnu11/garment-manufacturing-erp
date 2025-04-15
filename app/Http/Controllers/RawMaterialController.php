<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use App\Models\Raw_material;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        // Fetch raw materials (Products) with relationships, only with product_type_id = 1 (Raw Material)
        $rawMaterials = Product::with('category_type', 'uom', 'product_type') // Eager loading relationships
            ->where('product_type_id', 1) // Only fetch products with product_type_id = 1 (Raw Material)
            ->paginate(5); // Paginate results

        return view('pages.purchase_&_supliers.raw_materials.index', compact('rawMaterials'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
