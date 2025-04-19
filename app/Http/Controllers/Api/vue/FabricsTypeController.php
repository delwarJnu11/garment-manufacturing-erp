<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\FabricType;
use Illuminate\Http\Request;

class FabricsTypeController extends Controller
{
    public function index()
    {
        try {
            $fabrics = FabricType::all();
            if ($fabrics->isNotEmpty()) {
                return response()->json([
                    "status" => 200,
                    "message" => "All Fabrics Types Retrieve Successfully done!",
                    "fabrics" => $fabrics
                ]);
            } else {
                return response()->json([
                    "status" => 404,
                    "message" => "Fabrics Type Not Found!",
                    "fabrics" => []
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
