<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProductController;

use App\Models\Product_lot;
use App\Models\ProductLot;
use Illuminate\Http\Request;

class ProductlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_lots = ProductLot::paginate(5);
        $product_lots->load(['product', 'warehouse', 'transactionType']); // Load relationships after query execution

        return view('pages.purchase_&_supliers.product_lot.index', compact('product_lots'));
    }




    // public function index()
    // {
    //     $product_lots = ProductLot::with(['productVariant', 'warehouse'])->paginate(5);

    //     // Debug data before passing to view
    //     foreach ($product_lots as $lot) {
    //         dump($lot->product_variant);
    //         dump($lot->warehouse);
    //     }
    //     dd($product_lots); // Stop execution to see full data
    // }


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
