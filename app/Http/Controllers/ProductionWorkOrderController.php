<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductionPlan;
use App\Models\ProductionWorkOrder;
use App\Models\ProductionWorkSection;
use App\Models\ProductionWorkStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductionWorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $workOrders = ProductionWorkOrder::with([
            'assignedUser',
            'order',
            'productionPlan',
            'workStatus'
        ])->get();

        return view('pages.production.production_work_order.work_order.index', compact('workOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $encryptedOrderId = $request->query('order_id');
        if (!$encryptedOrderId) {
            return redirect()->route('production-plans.index')->with('error', 'Order ID is required.');
        }

        try {
            $order_id = Crypt::decrypt($encryptedOrderId);
        } catch (\Exception $e) {
            return redirect()->route('production-plans.index')->with('error', 'Invalid Order ID.');
        }

        $orders = Order::with('buyer')->get();
        $productionPlan = ProductionPlan::where('order_id', $order_id)->firstOrFail();
        $workStatuses = ProductionWorkStatus::all();
        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'Production');
        })->get();

        $single_order = Order::with('orderDetails')->findOrFail($order_id);
        $totalQty = $single_order->orderDetails->sum('qty');

        return view('pages.production.production_work_order.work_order.create', compact('orders', 'productionPlan', 'workStatuses', 'users', 'order_id', 'totalQty'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // print_r($request->all());
        // die;
        $request->validate([
            'order_id' => 'required|numeric',
            'production_plan_id' => 'required|numeric',
            'work_order_status_id' => 'required|numeric',
            'assigned_to' => 'required|numeric',
            'total_pieces' => 'required|integer|min:1',
            'wastage' => 'nullable|integer|min:0',
        ]);

        // ProductionWorkOrder::create([
        //     'order_id' => $request->order_id,
        //     'production_plan_id' => $request->production_plan_id,
        //     'production_work_section_id' => $request->production_work_section_id,
        //     'production_work_status_id' => $request->production_work_status_id,
        //     'assigned_to' => $request->assigned_to,
        //     'target_quantity' => $request->target_quantity,
        //     'actual_quantity' => $request->actual_quantity ?? 0,
        // ]);

        ProductionWorkOrder::create($request->all());

        return redirect()->route('production-work-orders.index')->with('success', 'Production work order has bee successfully created');
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
