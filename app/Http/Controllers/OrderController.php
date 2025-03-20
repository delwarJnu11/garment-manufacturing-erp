<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\FabricType;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with([
            'buyer',
            'status',
            'orderDetails.product',
            'orderDetails.size',
            'orderDetails.color',
            'orderDetails.uom'
        ])->whereHas('status', function ($query) {
            $query->where('name', 'Pending');
        })->groupBy('order_number')->paginate(4);

        // Get all unique sizes dynamically
        $sizes = Size::pluck('name')->toArray();

        return view('pages.orders_&_buyers.order.index', compact('orders', 'sizes'));
    }
    /**
     * In Progress Orders
     */
    public function runningOrders()
    {
        $orders = Order::with([
            'buyer',
            'status',
            'orderDetails.product',
            'orderDetails.size',
            'orderDetails.color',
            'orderDetails.uom'
        ])->whereHas('status', function ($query) {
            $query->where('name', 'In Progress');
        })->groupBy('order_number')->paginate(4);

        // Get all unique sizes dynamically
        $sizes = Size::pluck('name')->toArray();

        return view('pages.orders_&_buyers.order.running', compact('orders', 'sizes'));
    }

    /**
     * Display Completed Orders
     */
    public function completedOrders()
    {
        $orders = Order::with([
            'buyer',
            'status',
            'orderDetails.product',
            'orderDetails.size',
            'orderDetails.color',
            'orderDetails.uom'
        ])->whereHas('status', function ($query) {
            $query->where('name', 'Completed');
        })->groupBy('order_number')->paginate(4);

        // Get all unique sizes dynamically
        $sizes = Size::pluck('name')->toArray();

        return view('pages.orders_&_buyers.order.completed', compact('orders', 'sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buyers = Buyer::all();
        $supervisors = User::whereHas('role', function ($query) {
            $query->where('name', 'Supervisor');
        })->get();
        $order_status = OrderStatus::all();
        $fabrics_types = FabricType::all();

        return view('pages.orders_&_buyers.order.create', compact('buyers', 'supervisors', 'order_status', 'fabrics_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buyer_id'         => 'required|integer',
            'supervisor_id'    => 'required|integer',
            'status_id'        => 'required|integer',
            'fabric_type_id'   => 'required|integer',
            'gsm'              => 'required|string',
            'delivery_date'    => 'required|date',
            'description'      => 'nullable|string|max:1000',
        ], [
            'buyer_id.required'         => 'The buyer field is required.',
            'buyer_id.integer'          => 'The buyer must be a valid integer.',
            'supervisor_id.required'    => 'The supervisor field is required.',
            'supervisor_id.integer'     => 'The supervisor must be a valid integer.',
            'status_id.required'        => 'The status field is required.',
            'status_id.integer'         => 'The status must be a valid integer.',
            'fabric_type_id.required'   => 'The fabric type field is required.',
            'fabric_type_id.integer'    => 'The fabric type must be a valid integer.',
            'gsm.required'              => 'The GSM field is required.',
            'delivery_date.required'    => 'The delivery date is required.',
            'delivery_date.date'        => 'The delivery date must be a valid date.',
            'description.string'        => 'The description must be a string.',
            'description.max'           => 'The description may not be greater than 1000 characters.',
        ]);

        // Generate the order number with current time
        $orderNumber = 'ORD-' . time();


        $order = Order::create([
            'order_number'  => $orderNumber,
            'buyer_id'      => $request->buyer_id,
            'supervisor_id' => $request->supervisor_id,
            'status_id'     => $request->status_id,
            'fabric_type_id' => $request->fabric_type_id,
            'gsm'           => $request->gsm,
            'delivery_date' => $request->delivery_date,
            'description'   => $request->description,
        ]);

        // Return success response
        return redirect()->route('order_details.create')->with('success', 'Order created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $buyer = $order->buyer;

        $orderDetails = OrderDetail::where('order_id', $order->id)
            ->with('product', 'size', 'color', 'uom')
            ->get();

        // Get BOM for this order
        $bom = $order->bom;

        // Initialize size-based costs
        $sizeData = [];

        if ($bom) {
            // Fetch BOM details and join with Product table
            $bomDetails = $bom->bomDetails()
                ->select('size_id', 'quantity_used', 'unit_price', 'wastage')
                ->get()
                ->groupBy('size_id');

            // Fetch dynamic operating costs from BOM
            $operatingCost = $bom->utility_cost + $bom->labour_cost + $bom->overhead_cost;

            // Calculate material costs per size
            foreach ($bomDetails as $sizeId => $materials) {
                $materialCost = $materials->sum(function ($material) {
                    $wastageCost = ($material->quantity_used * ($material->wastage / 100)) * $material->unit_price;
                    return ceil(($material->quantity_used * $material->unit_price) + $wastageCost);
                });

                $sizeData[$sizeId] = [
                    'material_cost' => $materialCost,
                    'operating_cost' => $operatingCost,
                ];
            }
        }

        return view('pages.orders_&_buyers.order.show', compact('order', 'buyer', 'orderDetails', 'sizeData'));
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
