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
        $result = Production_plan_statuses::create([
            'name' => $request->status_name,
        ]);
        if ($result) {
            return redirect()->route('production_plan_status.index')->with('success', 'Production Status has been added successfully!');
        } else {
            return redirect()->back()->with('error', 'Production Status created failed!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Production_plan_statuses $production_plan_statuses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Production_plan_statuses $production_plan_statuses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Production_plan_statuses $production_plan_statuses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Production_plan_statuses $production_plan_statuses)
    {
        //
    }
}
