<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bom;
use App\Models\BomDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BomDetailsController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $bom = Bom::latest()->first();
            
            $request->validate([
                'items' => 'required|array',
                'items.*.material_id' => 'required|integer',
                'items.*.size_id' => 'required|integer',
                'items.*.quantity_used' => 'required|numeric',
                'items.*.uom_id' => 'required|integer',
                'items.*.unit_price' => 'required|numeric',
                'items.*.wastage' => 'required|numeric',
            ]);

            foreach ($request->items as $item) {
                BomDetails::create([
                    'bom_id' => $bom->id,
                    'material_id' => $item['material_id'],
                    'size_id' => $item['size_id'],
                    'quantity_used' => $item['quantity_used'],
                    'uom_id' => $item['uom_id'],
                    'unit_price' => $item['unit_price'],
                    'wastage' => $item['wastage'],
                ]);
            }

            $bom->update([
                'material_cost' => ceil($request->material_cost),
                'total_cost' => ceil($request->material_cost + $bom->labour_cost + $bom->overhead_cost + $bom->utility_cost),
            ]);

            DB::commit();
            
            return response()->json(['message' => 'Items saved successfully', 'status' => 201]);
        
        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json([
                'message' => 'Error saving BOM details',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
