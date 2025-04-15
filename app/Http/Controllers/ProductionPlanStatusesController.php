<?php

namespace App\Http\Controllers;

use App\Models\Production_plan_statuses;
use Illuminate\Http\Request;

class ProductionPlanStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get All Production Plan Status
        $production_plan_status = Production_plan_statuses::all();
        return view('pages.production.production_plan.production_plan_status.index', compact('production_plan_status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.production.production_plan.production_plan_status.create');
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
        Production_plan_statuses::create([
            'name' => $request->status_name,
        ]);
        return redirect()->route('production_plan_status.index')->with('success', 'Production Status has been added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Production_plan_statuses $production_plan_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Production_plan_statuses $production_plan_status)
    {
        return view('pages.production.production_plan.production_plan_status.edit', compact('production_plan_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Production_plan_statuses $production_plan_status)
    {
       $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        $production_plan_status->name = $request->status_name;
        $production_plan_status->save();
        
        return redirect()->route('production_plan_status.index')->with('success', 'Production Status has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Production_plan_statuses $production_plan_status)
    {
        $production_plan_status->delete();
        return redirect()->route('production_plan_status.index')->with('success', 'Production Status has been deleted successfully!');
    }
}
