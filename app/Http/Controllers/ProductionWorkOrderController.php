<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductionPlan;
use App\Models\ProductionWorkOrder;
use App\Models\ProductionWorkSection;
use App\Models\ProductionWorkStatus;
use App\Models\User;
use Illuminate\Http\Request;

class ProductionWorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::with('buyer')->get();
        $productionPlans = ProductionPlan::all();
        $workSections = ProductionWorkSection::all();
        $workStatuses = ProductionWorkStatus::all();
        $users = User::all();
       return view('pages.production.production_work_order.work_order.create', compact('orders', 'productionPlans', 'workSections', 'workStatuses', 'users'));
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
    public function show(ProductionWorkOrder $productionWorkOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionWorkOrder $productionWorkOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionWorkOrder $productionWorkOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionWorkOrder $productionWorkOrder)
    {
        //
    }
}
