<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Raw_material;

class RawMaterialController extends Controller
{
    public function show($id)
    {
        try {
            $rawMaterialId = Product::where('name', 'Raw Material')->first()?->id;
            $rawMaterial = Product::where('product_type_id', $rawMaterialId)->get();
            return response()->json($rawMaterial);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Raw material not found.'], 404);
        }
    }
}
