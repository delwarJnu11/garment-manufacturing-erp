<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\BomDetails;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductionPlan;
use App\Models\ProductionWorkOrder;
use App\Models\ProductionWorkSection;
use App\Models\ProductionWorkStatus;
use App\Models\ProductLot;
use App\Models\Stock;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'order_id' => 'required|numeric',
    //         'production_plan_id' => 'required|numeric',
    //         'work_order_status_id' => 'required|numeric',
    //         'assigned_to' => 'required|numeric',
    //         'total_pieces' => 'required|integer|min:1',
    //         'wastage' => 'nullable|integer|min:0',
    //     ]);

    //     $bom = Bom::findOrFail($request->order_id);

    //     $raw_material_used = BomDetails::where('bom_id', $bom->id)->sum('quantity_used')


    //     // ProductionWorkOrder::create([
    //     //     'order_id' => $request->order_id,
    //     //     'production_plan_id' => $request->production_plan_id,
    //     //     'production_work_section_id' => $request->production_work_section_id,
    //     //     'production_work_status_id' => $request->production_work_status_id,
    //     //     'assigned_to' => $request->assigned_to,
    //     //     'target_quantity' => $request->target_quantity,
    //     //     'actual_quantity' => $request->actual_quantity ?? 0,
    //     // ]);

    //     ProductionWorkOrder::create($request->all());

    //     return redirect()->route('production-work-orders.index')->with('success', 'Production work order has bee successfully created');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|numeric',
            'production_plan_id' => 'required|numeric',
            'work_order_status_id' => 'required|numeric',
            'assigned_to' => 'required|numeric',
            'total_pieces' => 'required|integer|min:1',
            'wastage' => 'nullable|integer|min:0',
        ]);

        // Find BOM based on order_id
        $bom = Bom::where('order_id', $request->order_id)->first();

        // Fetch raw material usage grouped by size_id
        $materialUsedQuantities = BomDetails::where('bom_id', $bom->id)
            ->select('size_id', DB::raw('SUM(quantity_used + (quantity_used * (wastage / 100))) as final_quantity'))
            ->groupBy('size_id')
            ->get()
            ->keyBy('size_id');

        // Fetch order quantities by size_id
        $orderQuantities = OrderDetail::where('order_id', $request->order_id)
            ->pluck('qty', 'size_id')
            ->toArray();

        // Initialize result array
        $result = [];

        // Calculate the material usage based on the order quantities
        foreach ($materialUsedQuantities as $size_id => $item) {
            $quantity = (float)$item->final_quantity;

            if (isset($orderQuantities[$size_id])) {
                $orderQuantity = (int)$orderQuantities[$size_id];
                // Perform the multiplication
                $result[$size_id] = $quantity * $orderQuantity;
            }
        }

        // Calculate total material used
        $totalMaterialUsed = array_sum($result);

        // Fetch the product ID for the BOM
        $productId = BomDetails::where('bom_id', $bom->id)->value('material_id');

        // Fetch product lot (if needed)
        $productLot = ProductLot::where('product_id', $productId)
            ->select('id', 'qty')
            ->get();

        while ($totalMaterialUsed > 0) {
            $lot = ProductLot::where('product_id', $productId)
                ->where('qty', '>', 0)
                ->orderBy('created_at', 'asc')
                ->first();
            if (!$lot) {
                throw new Exception('Not enough stock for product:');
            }

            $deductQty = min($lot->qty, $totalMaterialUsed);
            $lot->decrement('qty', $deductQty);

            $totalMaterialUsed -= $deductQty;

            $stock = new Stock();
            $stock->product_id = $productId;
            $stock->qty = $totalMaterialUsed;
            $stock->qty -= $deductQty;
            $stock->transaction_type_id = 1;
            $stock->lot_id = $productLot;
            $stock->save();
        }



        // Create Production Work Order
        ProductionWorkOrder::create($request->all());

        return redirect()->route('production-work-orders.index')->with('success', 'Production work order has been successfully created');
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
