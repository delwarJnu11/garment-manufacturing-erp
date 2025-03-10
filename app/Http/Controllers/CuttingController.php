<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\BomDetails;
use App\Models\Cutting;
use App\Models\ProductionWorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CuttingController extends Controller
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
    public function create(Request $request)
    {
        $encrypted_work_order_id = $request->query('work-order-id');

        if (!$encrypted_work_order_id) {
            return redirect()->route('production-work-orders.index')->with('error', 'Work Order ID is required.');
        }

        try {
            $work_order_id = Crypt::decrypt($encrypted_work_order_id);
        } catch (\Exception $e) {
            return redirect()->route('production-work-orders.index')->with('error', 'Invalid Order ID.');
        }

        // Get order_id from ProductionWorkOrder
        $workOrder = ProductionWorkOrder::find($work_order_id);
        if (!$workOrder) {
            return redirect()->route('production-work-orders.index')->with('error', 'Work Order not found.');
        }

        $order_id = $workOrder->order_id;

        // Get BOM entry based on order_id
        $bom = Bom::where('order_id', $order_id)->first();
        if (!$bom) {
            return redirect()->route('production-work-orders.index')->with('error', 'No BOM found for this order.');
        }

        $bom_id = $bom->id;

        // Get total quantity_used from BOMDetails based on bom_id
        $total_quantity_used = BomDetails::where('bom_id', $bom_id)->sum('quantity_used');

        return view('pages.production.cutting.create', compact('work_order_id', 'order_id', 'bom_id', 'total_quantity_used'));
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
    public function show(Cutting $cutting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cutting $cutting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cutting $cutting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cutting $cutting)
    {
        //
    }
}
