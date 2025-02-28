<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = PurchaseOrder::all();
        return response()->json(['purchase' => $purchase]);
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
        $purchase = new PurchaseOrder();
        $purchase->supplier_id = $request->supplier_id;
        $purchase->delivery_date = date('Y-m-d H:i:s', strtotime('+7'));
        $purchase->shipping_address = $request->shipping_address;
        $purchase->purchase_total = $request->purchase_total;
        $purchase->paid_amount = $request->paid_amount;
        $purchase->description = $request->description;
        $purchase->status_id = $request->status_id;
        $purchase->discount = $request->discount;
        $purchase->vat = $request->vat;
        $purchase->created_at = date('Y-m-d H:i:s');
        date_default_timezone_set('Asia/Dhaka');
        $purchase->save();
        $lastInsertedId = $purchase->id;

        $productData = $request->products;
        foreach ($productData as $product) {
            $purchaseDetail = new PurchaseOrderDetail();
            $purchaseDetail->purchase_id = $lastInsertedId;
            $purchaseDetail->product_variant_id = $product['item_id'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
