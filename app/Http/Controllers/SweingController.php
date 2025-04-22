<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\ProductionWorkOrder;
use App\Models\QualityCheck;
use App\Models\Sweing;
use App\Models\Wastage;
use App\Services\WastageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SweingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sweings = Sweing::where('sewing_status', 'In Progress')->orderBy('id', 'desc')->paginate(4);
        return view('pages.production.sweing.index', compact('sweings'));
    }

    /**
     * Display a listing of the resource.
     */
    public function completedSweings()
    {
        $sweings = Sweing::where('sewing_status', 'Completed')->orderBy('id', 'desc')->paginate(4);

        foreach ($sweings as $sweing) {
            $workOrderId = $sweing->work_order_id;

            // Check if work_order_id exists in the QualityCheck table
            $qcExists = QualityCheck::where('work_order_id', $workOrderId)->exists();

            $sweing->qc_exists = $qcExists;
        }
        return view('pages.production.sweing.completed', compact('sweings'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sweing $sweing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sweing $sweing)
    {
        return view('pages.production.sweing.edit', compact('sweing'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'cutting_id' => 'required|integer',
            'work_order_id' => 'required|integer',
            'sewing_status' => 'required|string|in:Pending,In Progress,Completed',
            'total_quantity' => 'required|integer|min:0',
            'target_quantity' => 'required|integer|min:0',
            'actual_quantity' => 'required|integer|min:0',
            'swen_complete' => 'required|integer|min:0',
            'wastage' => 'required|integer|min:0',
            'sewing_start_date' => 'nullable|date',
            'sewing_end_date' => 'nullable|date|after_or_equal:sewing_start_date',
            'remarks' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $sewing = Sweing::findOrFail($id);

            $efficiency = ($request->total_quantity > 0)
                ? ($request->actual_quantity / $request->total_quantity) * 100
                : 0;

            $sewing_status = ($request->total_quantity == $request->actual_quantity)
                ? 'Completed'
                : $request->sewing_status;

            $sewing_completed = $sewing->swen_complete + $request->swen_complete;

            $workOrder = ProductionWorkOrder::find($request->work_order_id);
            $productId = OrderDetail::where('order_id', $workOrder->order_id)->value('product_id');

            // Wastage Create
            if ($request->wastage > 0) {
                $wastageService = new WastageService();

                // find wastage based on Order id
                $result = Wastage::where('order_id', $workOrder->order_id)->exists();
                if (!$result) {
                    $wastageService->createWastage([
                        'order_id' => optional($workOrder)->order_id,
                        'product_id' => $productId,
                        'work_order_id' => $request->work_order_id,
                        'quantity' => $request->wastage,
                        'section' => 'Sewing',
                        'wastage_type_name' => 'Sweing Defect',
                        'remarks' => 'Defect found while sweinging',
                        'is_sellable' => true,
                    ]);

                    // Update Work Order Wastage
                    $workOrder->wastage = $request->wastage;
                    $workOrder->save();
                } else {
                    $wastage = Wastage::where('order_id', $workOrder->order_id)->first();
                    $newQty = $wastage->quantity + $request->wastage;

                    $wastage->quantity = $newQty;
                    $wastage->save();

                    // Update Work Order Wastage
                    $workOrder->wastage = $newQty;
                    $workOrder->save();
                }
            }

            $wastageQty = ($request->wastage ?? 0) + ($sewing->wastage ?? 0);

            // Sewing update
            $sewing->update([
                'sewing_status' => $sewing_status,
                'actual_quantity' => $request->actual_quantity,
                'swen_complete' => $sewing_completed,
                'wastage' => $wastageQty,
                'efficiency' => round($efficiency, 2),
                'sewing_end_date' => $request->sewing_end_date,
                'remarks' => $request->remarks,
            ]);

            // Update Work Order Status if Completed
            if ($sewing_status == 'Completed') {
                $workOrder->update([
                    'sewing_status' => 'Completed'
                ]);
            }

            DB::commit();

            return redirect()->route('sweing.index')->with('success', 'Sweing details updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sweing $sweing)
    {
        //
    }
}
