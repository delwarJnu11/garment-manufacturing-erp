<?php

namespace App\Http\Controllers;

use App\Models\InvoiceStatus;
use App\Models\PurchaseOrder;
use App\Models\PurchaseStatus;
use Illuminate\Http\Request;

class PurchaseStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     // Fetch all purchase statuses
    //     $purchase_status = PurchaseStatus::all();

    //     // Fetch the selected state from the request, default to null if not set
    //     $selectedState = $request->query('state', null);

    //     // Query the purchase orders with related data
    //     $query = PurchaseOrder::with('inv_supplier', 'product_lot', 'purchase_status');

    //     // If a state is selected, filter by it
    //     if ($selectedState) {
    //         $query->where('status_id', '!=', '2', $selectedState);
    //     }

    //     $purchaseStates = $query->paginate(6);

    //     // Pass data to the view
    //     return view('pages.purchase_&_supliers.purchase_order.index', compact('purchaseStates', 'purchase_status', 'selectedState'));
    // }

    public function index(Request $request)
    {
        // Fetch all purchase statuses
        $purchase_status = InvoiceStatus::all();

        // Fetch the selected state from the request, default to null if not set
        $selectedState = $request->query('state', null);

        // Query the purchase orders with related data
        $query = PurchaseOrder::with('inv_supplier', 'product_lot', 'purchase_status');

        // Filter by selected state, excluding status_id = 2 (Confirmed)
        if ($selectedState) {
            // If a state is selected, filter by it
            $query->where('status_id', $selectedState);
        } else {
            // Ensure status_id = 2 (Confirmed) is excluded for pending orders
            $query->where('status_id', '!=', 2);
        }

        $purchaseStates = $query->paginate(6);

        // Pass data to the view
        return view('pages.purchase_&_supliers.purchase_order.index', compact('purchaseStates', 'purchase_status', 'selectedState'));
    }






    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
}
