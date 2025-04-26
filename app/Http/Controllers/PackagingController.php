<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Packaging;
use App\Models\Product;
use App\Models\Production_plan_statuses;
use App\Models\ProductionPlan;
use App\Models\ProductionWorkOrder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackagingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packageItems = Packaging::with(['order', 'product', 'user'])->paginate(4);

        return view('pages.production.packaging.index', compact('packageItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // get order id and work order id from query params
        $workOrderId = $request->query('work_order_id');
        $orderId = $request->query('order_id');

        // Find the order and its details
        $order = Order::with('orderDetails')->findOrFail($orderId);

        $totalQuantity = $order->orderDetails->sum('qty');
        $productId = $order->orderDetails->first()?->product_id;
        $productName = Product::find($productId)?->name;

        // Get the packaging manager role ID
        $packageManagerRoleID = Role::where('name', 'Packaging Manager')->first()?->id;
        // Get the users with the packaging manager role
        $packageManagers = User::where('role_id', $packageManagerRoleID)->get();


        return view('pages.production.packaging.create', compact('order', 'workOrderId', 'totalQuantity', 'productId', 'productName', 'packageManagers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'work_order_id' => 'required|exists:production_work_orders,id',
            'product_id' => 'required|exists:products,id',
            'total_quantity' => 'required|integer|min:1',
            'packaged_quantity' => 'required|integer|min:0|max:' . $request->total_quantity,
            'remarks' => 'nullable|string|max:255',
            'packaged_by' => 'required|exists:users,id',
            'status' => 'required|in:Pending,In Progress,Completed',
            'packaging_start' => 'nullable|date',
            'packaging_end' => 'nullable|date|after_or_equal:packaging_start',
        ]);

        // Find Work Order BAsed on work Order id
        $workOrder = ProductionWorkOrder::find($request->work_order_id);
        if (!$workOrder) {
            return redirect()->back()->with('error', 'Work Order not found.');
        }
        $workOrder->update([
            'packaging_status' => 'In Progress',
        ]);

        Packaging::create([
            'order_id' => $request->order_id,
            'work_order_id' => $request->work_order_id,
            'product_id' => $request->product_id,
            'total_quantity' => $request->total_quantity,
            'packaged_quantity' => $request->packaged_quantity,
            'remarks' => $request->remarks,
            'status' => $request->status,
            'packaged_by' => $request->packaged_by,
            'packaging_start' => $request->packaging_start,
            'packaging_end' => $request->packaging_end,
        ]);

        return redirect()->route('packaging.index')->with('success', 'Packaging created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Packaging $packaging)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Packaging $packaging)
    {
        $packaging->load(['order', 'product']);

        $packageManagerRoleID = Role::where('name', 'Packaging Manager')->first()?->id;
        $packageManagers = User::where('role_id', $packageManagerRoleID)->get();

        return view('pages.production.packaging.edit', compact('packaging', 'packageManagers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Packaging $packaging)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'total_quantity' => 'required|integer|min:1',
            'packaged_quantity' => 'required|integer|min:1|max:' . $request->total_quantity,
            'remarks' => 'nullable|string|max:255',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);
        DB::beginTransaction();
        try {
            $packaging->update([
                'order_id' => $request->order_id ?? $packaging->order_id,
                'product_id' => $request->product_id ?? $packaging->product_id,
                'total_quantity' => $request->total_quantity ?? $packaging->total_quantity,
                'packaged_quantity' => $request->packaged_quantity,
                'remarks' => $request->remarks ?? $packaging->remarks,
                'status' => $request->status ?? $packaging->status,
                'packaging_start' => $request->packaging_start,
            ]);

            // Find Work Order BAsed on Order id
            $workOrder = ProductionWorkOrder::where('order_id', $request->order_id)->first();

            if ($request->status == 'Completed') {
                $workOrder->update([
                    'packaging_status' => 'Completed',
                ]);

                // Update ORder Status
                $order = Order::find($request->order_id);
                $orderStatusId = OrderStatus::where('name', 'Completed')->first()?->id;
                $order->update([
                    'status_id' => $orderStatusId,
                ]);

                // update Production Plan Status
                $productionPlan = ProductionPlan::where('order_id', $request->order_id)->first();
                $planStatusId = Production_plan_statuses::where('name', 'Completed')->first()?->id;
                $productionPlan->update([
                    'production_plan_status_id' => $planStatusId,
                ]);
            }
            DB::commit();
            return redirect()->route('packaging.index')->with('success', 'Packaging updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Handle the error
            return redirect()->back()->with('error', 'An error occurred while updating the packaging: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Packaging $packaging)
    {
        //
    }
}
