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
        try {
            $purchase = new PurchaseOrder();
            $purchase->supplier_id = $request->supplier_id;
            $purchase->delivery_date = now()->addDays(7);
            $purchase->shipping_address = $request->shipping_address;
            $purchase->purchase_total = $request->purchase_total;
            $purchase->paid_amount = $request->paid_amount;
            $purchase->description = $request->description;
            $purchase->status_id = $request->status_id;
            $purchase->discount = $request->discount;
            $purchase->vat = $request->vat;
            $purchase->created_at = now();
            $purchase->save();

            // Get the last inserted purchase ID
            $lastInsertedId = $purchase->id;

            foreach ($request->products as $product) {
                PurchaseOrderDetail::create([
                    'purchase_id' => $lastInsertedId,
                    'product_variant_id' => $product['item_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'discount' => $product['discount']
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Purchase order created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
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
