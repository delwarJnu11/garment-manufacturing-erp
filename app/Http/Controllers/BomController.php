<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\Order;
use App\Models\Raw_material;
use App\Models\Size;
use Illuminate\Http\Request;

class BomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('pages.production.bom.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::with([
            'buyer',
            'status',
            'orderDetails.product',
            'orderDetails.size',
            'orderDetails.color',
            'orderDetails.uom'
        ])->groupBy('order_number')->get();

        // Extract product names and IDs and ensure uniqueness
        $products = $orders->flatMap(function ($order) {
            return $order->orderDetails->map(function ($detail) use ($order) {
                return [
                    'order_id' => $order->id,
                    'name' => $detail->product->name,
                ];
            });
        })->unique('name')->values();

        return view('pages.production.bom.create', compact('orders', 'products'));

        // return view('pages.production.bom.create', compact('orders'));
    }

    // public function create()
    // {
    //     $materials = Raw_material::all();
    //     $sizes = Size::all();
    //     return view('pages.production.bom.create', compact('materials', 'sizes'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;

        $request->validate([
            'order_id' => 'required|integer',
            'material_cost' => 'nullable|numeric',
            'labour_cost' => 'required|numeric',
            'overhead_cost' => 'required|numeric',
            'utility_cost' => 'required|numeric',
            'total_cost' => 'nullable|numeric',
        ]);

        Bom::create([
            'order_id' => $request->order_id,
            'material_cost' => 0,
            'labour_cost' => $request->labour_cost,
            'overhead_cost' => $request->overhead_cost,
            'utility_cost' => $request->utility_cost,
            'total_cost' => 0,
        ]);
        return redirect()->route('bom_details.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bom $bom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bom $bom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bom $bom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bom $bom)
    {
        //
    }
}
