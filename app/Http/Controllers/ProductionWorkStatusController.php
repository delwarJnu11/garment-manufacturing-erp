<?php

namespace App\Http\Controllers;

use App\Models\ProductionWorkStatus;
use Illuminate\Http\Request;

class ProductionWorkStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = ProductionWorkStatus::all();
        return view('pages.production.production_work_order.production_work_status.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.production.production_work_order.production_work_status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status_name' => 'required|string|max:50',
        ], [
            'required' => 'Staus name is required!',
        ]);

        // Create a new role
        ProductionWorkStatus::create([
            'name' => $request->status_name,
        ]);
        return redirect()->route('production-work-status.index')->with('success', 'Production work Status has been added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionWorkStatus $productionWorkStatus)
    {
        return view('pages.production.production_work_order.production_work_status.show', compact('productionWorkStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionWorkStatus $productionWorkStatus)
    {
        return view('pages.production.production_work_order.production_work_status.edit', compact('productionWorkStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionWorkStatus $productionWorkStatus)
    {
        $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        $productionWorkStatus->name = $request->status_name;
        $productionWorkStatus->save();

        return redirect()->route('production-work-status.index')->with('success', 'Production work Status has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionWorkStatus $productionWorkStatus)
    {
        $productionWorkStatus->delete();
        return redirect()->route('production-work-status.index')->with('success', 'Production Work Status has been deleted successfully!');
    }
}
