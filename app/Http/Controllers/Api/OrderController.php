<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\FabricType;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Role;
use App\Models\User;

class OrderController extends Controller
{
    // Retrieve all orders
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    // Create a new order
    public function store(Request $request)
    {
        $request->validate([
            'buyer_id' => 'required|integer',
            'supervisor_id' => 'required|integer',
            'status_id' => 'required|integer',
            'fabric_type_id' => 'required|integer',
            'gsm' => 'required|integer',
            'delivery_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $order = Order::create([
            'order_number' => 'ORD-' . time(),
            'buyer_id' => $request->buyer_id,
            'supervisor_id' => $request->supervisor_id,
            'status_id' => $request->status_id,
            'fabric_type_id' => $request->fabric_type_id,
            'gsm' => $request->gsm,
            'delivery_date' => $request->delivery_date,
            'description' => $request->description,
        ]);

        return response()->json($order, 201);
    }

    public function getBuyers()
    {
        return response()->json(Buyer::select('id', 'first_name', 'last_name')->get());
    }

    public function getSupervisors()
    {
        $supervisorRole = Role::where('name', 'Supervisor')->first();

        if (!$supervisorRole) {
            return response()->json(['message' => 'Supervisor role not found'], 404);
        }

        $supervisors = User::where('role_id', $supervisorRole->id)
            ->select('id', 'name', 'email') // Fetch only required fields
            ->get();

        return response()->json($supervisors);
    }

    public function getOrderStatuses()
    {
        return response()->json(OrderStatus::select('id', 'name')->get());
    }
    public function getFabricsTypes()
    {
        return response()->json(FabricType::select('id', 'name')->get());
    }
}
