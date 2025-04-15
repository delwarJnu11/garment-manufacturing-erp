<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\BomDetails;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Raw_material;
use App\Models\Size;
use App\Models\Uom;
use Illuminate\Http\Request;

class BomDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Raw_material::all();
        $sizes = Size::all();
        $uoms = Uom::all();
        return view('pages.production.bom_details.create', compact('products', 'sizes', 'uoms'));
    }
    

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
    public function show(BomDetails $bomDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BomDetails $bomDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BomDetails $bomDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BomDetails $bomDetails)
    {
        //
    }
}
