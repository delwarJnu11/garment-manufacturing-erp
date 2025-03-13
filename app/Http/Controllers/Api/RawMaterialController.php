<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Raw_material;

class RawMaterialController extends Controller
{
    public function show($id)
    {
        try {
            $rawMaterial = Raw_material::findOrFail($id);
            return response()->json($rawMaterial);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Raw material not found.'], 404);
        }
    }
}
