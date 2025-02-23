<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(4);
        return view('pages.sales-and-orders.order.create', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('pages.sales-and-orders.order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buyer_id'         => 'required|integer',
            'supervisor_id'    => 'required|integer',
            'status_id'        => 'required|integer',
            'fabric_type_id'   => 'required|integer',
            'gsm'              => 'required|string',
            'delivery_date'    => 'required|date',
            'description'      => 'nullable|string|max:1000',
        ], [
            'buyer_id.required'         => 'The buyer field is required.',
            'buyer_id.integer'          => 'The buyer must be a valid integer.',
            'supervisor_id.required'    => 'The supervisor field is required.',
            'supervisor_id.integer'     => 'The supervisor must be a valid integer.',
            'status_id.required'        => 'The status field is required.',
            'status_id.integer'         => 'The status must be a valid integer.',
            'fabric_type_id.required'   => 'The fabric type field is required.',
            'fabric_type_id.integer'    => 'The fabric type must be a valid integer.',
            'gsm.required'              => 'The GSM field is required.',
            'delivery_date.required'    => 'The delivery date is required.',
            'delivery_date.date'        => 'The delivery date must be a valid date.',
            'description.string'        => 'The description must be a string.',
            'description.max'           => 'The description may not be greater than 1000 characters.',
        ]);

        // Generate the order number with current time
        $orderNumber = 'ORD-' . time();

        // Now manually assign and create the order
        $order = Order::create([
            'order_number'  => $orderNumber,
            'buyer_id'      => $request->buyer_id,
            'supervisor_id' => $request->supervisor_id,
            'status_id'     => $request->status_id,
            'fabric_type_id' => $request->fabric_type_id,
            'gsm'           => $request->gsm,
            'delivery_date' => $request->delivery_date,
            'description'   => $request->description,
        ]);

        // Return success response
        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
