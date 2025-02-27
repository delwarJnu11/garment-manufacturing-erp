<?php

namespace App\Http\Controllers;

use App\Models\inv_suppliers;
use App\Models\ProductLot;
use App\Models\Purchase_status;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrders;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase_orders = PurchaseOrder::with(['inv_supplier', 'product_lot','purchase_status'])->paginate(5);
        return view('pages.purchase_&_supliers.purchase_order.index',compact('purchase_orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = inv_suppliers::all();
        $lots = ProductLot::all();
        $statuses = Purchase_status::all();

        return view('pages.purchase_&_supliers.purchase_order.create',compact('suppliers','lots','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrders)
    {
        //
    }
}
