<?php

namespace App\Http\Controllers;

use App\Models\ProductionWorkOrder;
use App\Models\QualityCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QualityCheckController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'work_order_id' => 'required|exists:production_work_orders,id',
            ]);

            $workOrder = ProductionWorkOrder::with('order')->findOrFail($request->work_order_id);

            // Create QC for check
            QualityCheck::create([
                'order_id' => $workOrder->order->id,
                'work_order_id' => $workOrder->id,
                'total_quantity' => $workOrder->total_pieces,
                'checked_quantity' => 0,
                'passed_quantity' => 0,
                'rejected_quantity' => 0,
                'remarks' => null,
                'status' => 'Pending',
                'checked_by' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Work Order fetched',
                'work_order' => [
                    'id' => $workOrder->id,
                    'order_no' => optional($workOrder->order)->order_number,
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QualityCheck $qualityCheck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QualityCheck $qualityCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QualityCheck $qualityCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QualityCheck $qualityCheck)
    {
        //
    }
}
