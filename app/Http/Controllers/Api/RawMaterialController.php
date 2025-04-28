<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Raw_material;

class RawMaterialController extends Controller
{
    public function show($id)
    {
        try {
            $rawMaterial = Product::where('product_type_id', $id)->first();
            if ($rawMaterial) {
                return response()->json($rawMaterial);
            } else {
                return response()->json(['message' => 'Raw material not found.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching raw materials.'], 500);
        }
    }
}
