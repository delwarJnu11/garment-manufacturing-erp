<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PurchaseReportController extends Controller
{
    /**
     * Display the initial purchase report page.
     */
    public function index()
    {

        return view('pages.purchase_&_supliers.purchaseReport.purchasereport', ['purchases' => []]);
    }

    /**
     * Fetch purchase orders based on the date range.
     */
    public function show(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Convert dates to Carbon instances for proper formatting
        $startDate = $startDate ? Carbon::parse($startDate)->startOfDay() : null;
        $endDate = $endDate ? Carbon::parse($endDate)->endOfDay() : null;

        $query = PurchaseOrder::query();

        if ($startDate && $endDate) {
            $query->whereBetween('purchase_date', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->where('purchase_date', '>=', $startDate);
        } elseif ($endDate) {
            $query->where('purchase_date', '<=', $endDate);
        }

        $purchases = $query->orderBy('purchase_date', 'asc')->get();

        
        return view('pages.purchase_&_supliers.purchaseReport.purchasereport', compact('startDate', 'endDate', 'purchases'));
    }
}
