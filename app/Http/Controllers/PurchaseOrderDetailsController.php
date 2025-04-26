<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;

class PurchaseOrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase_details = PurchaseOrderDetail::with('')->paginate(5);
        return view('pages.purchase_&_supliers.purchase_orderDetail.blade.php.index', compact('purchase_details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(PurchaseOrderDetail $purchase_order_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrderDetail $purchase_order_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrderDetail
    $purchase_order_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrderDetail $purchase_order_details) {}

    public function find_supplier() {}
}
