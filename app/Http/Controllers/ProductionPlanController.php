<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Production_plan_statuses;
use App\Models\ProductionPlan;
use Illuminate\Http\Request;

class ProductionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = ProductionPlan::with('order', 'status')->paginate(5);
        return view('pages.production.production_plan.plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::with('buyer')->get();
        $statuses = Production_plan_statuses::all();
        return view('pages.production.production_plan.plan.create', compact('orders', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'order_id' => 'required|integer',
            'production_plan_status_id' => 'required|integer',
            'production_line' => 'required|string',
            'daily_target' => 'required|integer',
            'allocated_machines' => 'required|integer',
            'allocated_workers' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        ProductionPlan::create($request->all());

        return redirect()->route('production-plans.index')->with('success', 'Production Plan Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionPlan $productionPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionPlan $productionPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionPlan $productionPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionPlan $productionPlan)
    {
        //
    }
}
