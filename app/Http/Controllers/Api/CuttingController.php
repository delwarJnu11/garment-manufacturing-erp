<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cutting;
use App\Models\ProductionWorkOrder;
use App\Models\Sweing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuttingController extends Controller
{
    function updateStatus(Request $request, $id)
    {
        $request->validate([
            'actual_quantity' => 'required|integer|min:0',
            'work_order_id'   => 'required|integer|exists:production_work_orders,id',
        ]);

        DB::beginTransaction();

        try {
            // Update the Cutting
            $cutting = Cutting::findOrFail($id);
            $cutting->update([
                'actual_quantity' => $request->actual_quantity,
                'cutting_status' => 'Completed'
            ]);


            // Update the ProductionWorkOrder
            $workOrder = ProductionWorkOrder::findOrFail($request->work_order_id);

            $updatedCutting = Cutting::findOrFail($id);

            // After Cutting Completed Sweing Start
            Sweing::create([
                'cutting_id'      => $updatedCutting->id,
                'work_order_id'   => $workOrder->id,
                'total_quantity'    => $updatedCutting->total_quantity,
                'target_quantity' => $updatedCutting->actual_quantity,
                'sewing_status'   => 'In Progress',
                'sewing_start_date' => now(),
            ]);

            $workOrder->update([
                'cutting_status' => 'Completed',
                'sewing_status' => 'In Progress'
            ]);

            DB::commit();

            return response()->json(['message' => 'Cutting status updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update cutting status', 'details' => $e->getMessage()], 500);
        }
    }
}
