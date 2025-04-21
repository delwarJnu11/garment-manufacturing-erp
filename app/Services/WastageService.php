<?php

namespace App\Services;

use App\Models\Wastage;
use App\Models\WastageType;
use App\Models\BOM;
use Illuminate\Support\Facades\Auth;

class WastageService
{
    public function createWastage($data)
    {
        $wastageType = WastageType::where('name', $data['wastage_type_name'])->first();

        if (!$wastageType) {
            throw new \Exception("Wastage Type '{$data['wastage_type_name']}' not found.");
        }

        // Unit Cost
        $bom = BOM::where('order_id', $data['order_id'])->first();
        $unitCost = $bom ? $bom->total_cost : 0;

        return Wastage::create([
            'order_id' => $data['order_id'],
            'product_id' => $data['product_id'],
            'wastage_type_id' => $wastageType->id,
            'work_order_id' => $data['work_order_id'] ?? null,
            'quantity' => $data['quantity'],
            'unit_price' => round($unitCost, 2),
            'section' => $data['section'] ?? null,
            'reported_by' => Auth::id(),
            'remarks' => $data['remarks'] ?? 'Auto generated',
            'wastage_date' => now(),
            'is_sellable' => $data['is_sellable'] ?? false,
        ]);
    }
}
