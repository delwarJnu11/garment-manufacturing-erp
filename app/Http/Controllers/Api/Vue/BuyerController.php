<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Buyer::query();

            if ($request->search) {
                $query->where('first_name', 'like', "%{$request->search}%")->orWhere('last_name', 'like', "%{$request->search}%");
            }

            $buyers = $query->paginate(3);

            if ($buyers->isEmpty()) {
                return response()->json([
                    'buyers' => [],
                    'success' => false,
                    'status' => 404,
                    'message' => 'No buyer found.'
                ]);
            }

            return response()->json([
                'buyers' => $buyers,
                'success' => true,
                'status' => 200,
                'message' => 'Buyers retrieved successfully.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Server Error: ' . $th->getMessage()
            ]);
        }
    }
}
