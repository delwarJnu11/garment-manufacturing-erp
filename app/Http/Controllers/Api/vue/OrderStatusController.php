<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function index()
    {
        try {
            $allStatus = OrderStatus::all();
            if ($allStatus->isNotEmpty()) {
                return response()->json([
                    "status" => 200,
                    "message" => "All Status Retrieve Successfully done!",
                    "statuses" => $allStatus
                ]);
            } else {
                return response()->json([
                    "status" => 404,
                    "message" => "Status Not Found!",
                    "statuses" => []
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 500,
                "message" => $th->getMessage(),
            ]);
        }
    }
}
