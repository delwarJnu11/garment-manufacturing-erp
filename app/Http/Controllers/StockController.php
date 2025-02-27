<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with('productVariant', 'warehouse')->paginate(5);
        return view('pages.inventory.stock.stock', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_variants = ProductVariant::all();
        $warehouses = Warehouse::all();
        return view('pages.inventory.stock.create', compact('product_variants', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_variant_id' => "required",
            'warehouse_id' => "required",
            'warehouse_id' => "nullable",
        ]);

        Stock::create([
            'product_variant_id' => $request->product_variant_id,
            'warehouse_id' => $request->warehouse_id,
            'total_value' => $request->total_value,
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stock overview created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
