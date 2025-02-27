<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\Order;
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
        $orders = Order::with('orderDetails.product')->get();
        $groupedOrderDetails = $orders->flatMap(function ($order) {
            return $order->orderDetails->map(function ($orderDetail) use ($order) {
                return [
                    'order_id' => $order->id,
                    'product_name' => $orderDetail->product->name,
                    'quantity' => $orderDetail->qty,
                    'subtotal' => $orderDetail->subtotal,
                ];
            });
        })->groupBy('order_id');

        return view('pages.production.bom.create', compact('groupedOrderDetails'));
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
