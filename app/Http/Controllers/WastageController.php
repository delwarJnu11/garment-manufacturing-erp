<?php

namespace App\Http\Controllers;

use App\Models\Wastage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WastageController extends Controller
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
        $request->validate([
            'order_id' => 'required|integer',
            'product_id' => 'required|integer',
            'wastage_type_id' => 'required|integer|exists:wastage_types,id',
            'work_order_id' => 'nullable|integer',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'nullable|numeric',
            'section' => 'nullable|string',
            'reported_by' => 'nullable|integer',
            'remarks' => 'nullable|string',
        ]);

        $wastage = Wastage::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'wastage_type_id' => $request->wastage_type_id,
            'work_order_id' => $request->work_order_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'section' => $request->section ?? 'Sewing',
            'reported_by' => Auth::auth()->id(),
            'is_sellable' => false,
            'remarks' => $request->remarks,
            'wastage_date' => now(),
        ]);

        if ($wastage) {
            return response()->json(['success' => true, 'message' => 'Wastage recorded successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to record wastage.'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wastage $wastage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wastage $wastage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wastage $wastage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wastage $wastage)
    {
        //
    }
}
