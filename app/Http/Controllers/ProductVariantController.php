<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Uom;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_variants = ProductVariant::with('product_type','size','uom')->paginate(4);
        return view('pages.inventory.product_variant.index', compact('product_variants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_types = ProductType::all();
        $sizes = Size::all();
        $uoms = Uom::all();

        return view('pages.inventory.product_variant.create',compact('product_types','sizes','uoms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|min:5",
            'product_type_id' => "required",
            'size' => "nullable",
            'sku' => "required|min:4",
            'qty' => "required",
            'uom_id' => "required",
            'unit_price' => "required",

        ]);

        ProductVariant::create([
            'name'=>$request->name,
            'product_type_id'=>$request->product_type_id,
            'size'=>$request->size,
            'sku'=>$request->sku,
            'qty'=>$request->qty,
            'uom_id'=>$request->uom_id,
            'unit_price'=>$request->unit_price,
        ]);
        return redirect('product_variants')->with('success','product variants create successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $productVariant)
    {
        //
    }
}
