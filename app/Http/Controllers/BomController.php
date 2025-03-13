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
        $sizes = Size::all();
        $boms = BOM::with(['order.buyer', 'orderDetails', 'bomDetails'])
            ->get()
            ->map(function ($bom) {
                $sizes = $bom->bomDetails->groupBy('size_id');

                // Dynamically generate size-based costs
                $sizeCosts = [];
                foreach ($sizes as $sizeId => $details) {
                    $sizeCosts["size_{$sizeId}"] = $details->sum(fn($detail) => ($detail->quantity_used + (($detail->wastage * $detail->quantity_used)/100)) * $detail->unit_price) ?? 0;
                }

                return array_merge([
                    'order_id' => $bom->order->order_number,
                    'buyer_name' => $bom->order->buyer->first_name ." ".$bom->order->buyer->last_name,
                    'product_name' => optional($bom->orderDetails->first())->product->name,
                    'labour_cost' => $bom->labour_cost,
                    'overhead_cost' => $bom->overhead_cost,
                    'utility_cost' => $bom->utility_cost,
                    'total_cost' => $bom->total_cost,
                    'delivery_date' => optional($bom->order->delivery_date)->format('d M Y'),
                    'status' => $bom->order->status,
                ], $sizeCosts);
            });

        return view('pages.production.bom.index', compact('boms','sizes'));
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
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
