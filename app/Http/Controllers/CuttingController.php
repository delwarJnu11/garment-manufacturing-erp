<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\BomDetails;
use App\Models\Cutting;
use App\Models\ProductionWorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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

        // Get work Order Id and total pieces
        $order_id = $workOrder->order_id;
        $total_pieces = $workOrder->total_pieces;

        // Get BOM entry based on order_id
        $bom = Bom::where('order_id', $order_id)->first();
        if (!$bom) {
            return redirect()->route('production-work-orders.index')->with('error', 'No BOM found for this order.');
        }

        $bom_id = $bom->id;

        // Get order quanity based on Size
        $sizeQuantities = DB::table('order_details')
            ->where('order_id', $order_id)
            ->select('size_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('size_id')
            ->pluck('total_qty', 'size_id');

        // Convert result into an array (size-wise quantity)
        $sizesWithQty = $sizeQuantities->toArray();

        // Get total quantity_used from BOMDetails based on bom_id
        $Quantities = BomDetails::where('bom_id', $bom_id)
            ->where('uom_id', 2)
            ->select('size_id', DB::raw('SUM(quantity_used) as total_quantity_used'))
            ->groupBy('size_id')
            ->pluck('total_quantity_used', 'size_id');

        // Convert to an array
        $sizesWithUsedQty = $Quantities->toArray();

        $totalFabricsUsed = 0;

        foreach ($sizesWithQty as $sizeId => $orderQty) {
            if (isset($sizesWithUsedQty[$sizeId])) {
                $totalFabricsUsed += $orderQty * $sizesWithUsedQty[$sizeId];
                break;
            }
        }

        $total_quantity_wastage = BomDetails::where('bom_id', $bom_id)->sum('wastage');

        return view('pages.production.cutting.create', compact('work_order_id', 'totalFabricsUsed', 'total_pieces'));
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
