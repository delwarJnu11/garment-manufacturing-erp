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
        $cuttingOrders = Cutting::with('workOrder.order')
            ->where('cutting_status', 'In Progress')
            ->paginate(4);
        return view('pages.production.cutting.index', compact('cuttingOrders'));
    }

    /**
     * Display Completed Cutting list
     */

    public function completed()
    {
        $completedCuttings = Cutting::with('workOrder.order')
            ->where('cutting_status', 'Completed')
            ->paginate(4);

        return view('pages.production.cutting.completed', compact('completedCuttings'));
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
            }
        }

        // Fetch all relevant data without averaging wastage
        $wastages = BomDetails::where('bom_id', $bom_id)
            ->where('uom_id', 2)
            ->select('size_id', 'quantity_used', 'wastage')
            ->get();

        $totalWastageBySize = [];

        foreach ($wastages as $row) {
            $sizeId = $row->size_id;
            $quantityUsed = $row->quantity_used;
            $wastagePercentage = $row->wastage;

            // Calculate wastage for this entry
            $wastage = ($quantityUsed * $wastagePercentage) / 100;

            // Sum wastage per size_id
            if (!isset($totalWastageBySize[$sizeId])) {
                $totalWastageBySize[$sizeId] = 0;
            }

            $totalWastageBySize[$sizeId] += $wastage;
        }

        $totalWastage = 0;

        foreach ($sizeQuantities as $sizeId => $quantity) {
            if (isset($totalWastageBySize[$sizeId])) {
                $totalWastage += $quantity * $totalWastageBySize[$sizeId];
            }
        }

        return view('pages.production.cutting.create', compact('work_order_id', 'totalFabricsUsed', 'total_pieces', 'totalWastage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'work_order_id'      => 'required|integer|exists:production_work_orders,id',
            'cutting_status'     => 'required|in:Pending,In Progress,Completed',
            'total_pieces'       => 'required|integer|min:1',
            'total_fabric_used'  => 'required|integer|min:1',
            'wastage'            => 'required|numeric|min:0',
            'target_quantity'    => 'required|integer|min:1',
            'actual_quantity'    => 'required|integer|min:0',
            'cutting_start_date' => 'required|date',
            'cutting_end_date'   => 'required|date|after_or_equal:cutting_start_date',
            'remarks'            => 'nullable|string|max:500',
        ]);

        DB::beginTransaction(); // Begin Transaction

        try {
            // Create a new cutting record
            $cutting = Cutting::create([
                'work_order_id'      => $request->work_order_id,
                'cutting_status'     => $request->cutting_status,
                'total_quantity'     => $request->total_pieces,
                'total_fabric_used'  => $request->total_fabric_used,
                'wastage'            => $request->wastage,
                'target_quantity'    => $request->target_quantity,
                'actual_quantity'    => $request->actual_quantity,
                'cutting_start_date' => $request->cutting_start_date,
                'cutting_end_date'   => $request->cutting_end_date,
                'remarks'            => $request->remarks
            ]);

            // Update cutting_status in ProductionWorkOrder
            $workOrder = ProductionWorkOrder::find($request->work_order_id);
            if ($workOrder) {
                $workOrder->update(['cutting_status' => 'In Progress']);
            }

            DB::commit();

            return redirect()->route('cutting.index')->with('success', 'Cutting is Created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('cutting.index')->with('error', 'Failed to create Cutting: ' . $e->getMessage());
        }
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
