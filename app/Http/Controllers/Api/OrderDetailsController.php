<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Size;
use App\Models\Uom;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = OrderDetail::paginate(10);
        return response()->json([
            'status'  => 200,
            'message' => 'Orders retrieved successfully',
            'data'    => $orders,
        ]);
    }

    // for React 
    public function getOrders()
    {
        $orders = Order::with([
            'buyer',
            'status',
            'orderDetails.product',
            'orderDetails.size',
            'orderDetails.color',
            'orderDetails.uom'
        ])->whereHas('status', function ($query) {
            $query->where('name', 'Pending');
        })->groupBy('order_number')->paginate(4);

        // Get all unique sizes dynamically
        $sizes = Size::pluck('name')->toArray();

        return response()->json([
            'status'  => 200,
            'message' => 'Orders retrieved successfully',
            'data'    => ['orders' => $orders, 'sizes' => $sizes],
        ]);
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
        $request->validate([
            'items'              => 'required|array',
            'items.*.product_id' => 'required|integer',
            'items.*.order_id'   => 'required|integer',
            'items.*.size_id'    => 'required|integer',
            'items.*.color_id'   => 'required|integer',
            'items.*.qty'        => 'required|integer|min:1',
            'items.*.uom_id'     => 'required|integer',
            'items.*.subtotal'   => 'required|numeric',
        ]);

        foreach ($request->items as $item) {
            OrderDetail::create($item);
        }

        return response()->json(['message' => 'Items saved successfully', 'status' => 201]);
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

    public function fetchData()
    {
        return response()->json([
            'products' => Product::select('id', 'name')->get(),
            'sizes' => Size::select('id', 'name')->get(),
            'uoms' => Uom::select('id', 'name')->get(),
            'colors' => Color::select('id', 'name')->get()
        ]);
    }
}
