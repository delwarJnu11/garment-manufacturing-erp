<?php

namespace App\Http\Controllers;

use App\Models\AdjusmentType;
use App\Models\Stock;
use App\Models\StockAdjustment;
use App\Models\AdjustmentType;
use Illuminate\Http\Request;

class StockAdjustmentController extends Controller
{
    /**
     * Display a listing of stock adjustments.
     */
    public function index()
    {
        $adjustments = StockAdjustment::with('stock.product', 'adjustmentType')->get();
        return view('pages.inventory.stockAdjustment.index', compact('adjustments'));
    }

    /**
     * Show the form for creating a new stock adjustment.
     */
    public function create()
    {
        $stocks = Stock::with('product', 'lot')->get();
        $adjustmentTypes = AdjustmentType::all();
        return view('pages.inventory.stockAdjustment.create', compact('stocks', 'adjustmentTypes'));
    }

    /**
     * Store a newly created stock adjustment.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'stock_id' => 'required|exists:stocks,id',
    //         'adjustment_type_id' => 'required|exists:adjustment_types,id',
    //         'adjusted_qty' => 'required|integer|min:1',
    //         'reason' => 'nullable|string',
    //     ]);

    //     $stock = Stock::findOrFail($validated['stock_id']);

    //     // Calculate the new remaining quantity
    //     $newRemainingQty = $stock->qty - $validated['adjusted_qty'];

    //     if ($newRemainingQty < 0) {
    //         return redirect()->back()->with('error', 'Not enough stock available for adjustment.');
    //     }

    //     // Create Stock Adjustment Record
    //     $adjustment = StockAdjustment::create([
    //         'stock_id' => $stock->id,
    //         'adjustment_type_id' => $validated['adjustment_type_id'],
    //         'adjusted_qty' => $validated['adjusted_qty'],
    //         'remaining_qty' => $newRemainingQty,
    //         'reason' => $validated['reason'] ?? null,
    //     ]);

    //     // Update the stock quantity
    //     $stock->update(['qty' => $newRemainingQty]);

    //     return redirect()->route('stock_adjustments.index')->with('success', 'Stock adjustment recorded successfully.');
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'adjustment_type_id' => 'required|exists:adjustment_types,id',
            'adjusted_qty' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        $stock = Stock::findOrFail($validated['stock_id']);

        // Identify the adjustment type (Assumption: '1' = Restock, '2' = Reduction)
        $adjustmentType = $validated['adjustment_type_id'];

        if ($adjustmentType == 2) { // Restock (Increase Stock)
            $newRemainingQty = $stock->qty + $validated['adjusted_qty'];
        } else { // Reduction (Decrease Stock)
            $newRemainingQty = $stock->qty - $validated['adjusted_qty'];

            if ($newRemainingQty < 0) {
                return redirect()->back()->with('error', 'Not enough stock available for adjustment.');
            }
        }

        // Create Stock Adjustment Record
        $adjustment = StockAdjustment::create([
            'stock_id' => $stock->id,
            'adjustment_type_id' => $adjustmentType,
            'adjusted_qty' => $validated['adjusted_qty'],
            'remaining_qty' => $newRemainingQty,
            'reason' => $validated['reason'] ?? null,
        ]);

        // Update the stock quantity
        $stock->update(['qty' => $newRemainingQty]);

        return redirect()->route('stock_adjustments.index')->with('success', 'Stock adjustment recorded successfully.');
    }
}
