<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = OrderStatus::all();
        return view('pages.orders_&_buyers.status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.orders_&_buyers.status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        OrderStatus::create([
            'name' => $request->name
        ]);

        return redirect()->route('order_status.index')->with('success', 'Order Status created successfully done!');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderStatus $orderStatus)
    {
        //
    }
}
