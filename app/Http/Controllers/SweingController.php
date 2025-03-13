<?php

namespace App\Http\Controllers;

use App\Models\ProductionWorkOrder;
use App\Models\Sweing;
use Illuminate\Http\Request;

class SweingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sweings = Sweing::paginate(4);
        return view('pages.production.sweing.index', compact('sweings'));
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
        // Validate the form data
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

        // Find the existing sewing
        $sewing = Sweing::findOrFail($id);

        $efficiency = ($request->total_quantity > 0)
            ? ($request->actual_quantity / $request->total_quantity) * 100
            : 0;

        $sewing_status = ($request->total_quantity == $request->actual_quantity) ? 'Completed' : $request->sewing_status;

        // Update Sewing table
        $sewing->update([
            'sewing_status' => $sewing_status,
            'actual_quantity' => $request->actual_quantity,
            'swen_complete' => $request->swen_complete,
            'wastage' => $request->wastage,
            'efficiency' => round($efficiency, 2),
            'sewing_end_date' => $request->sewing_end_date,
            'remarks' => $request->remarks,
        ]);

        // Update Production Work Order Status when completed
        if ($sewing_status == 'Completed') {
            ProductionWorkOrder::where('id', $request->work_order_id)
                ->update(['sewing_status' => 'Completed']);
        }

        // Redirect with success message
        return redirect()->route('sweing.index')->with('success', 'Sweing details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sweing $sweing)
    {
        //
    }
}
