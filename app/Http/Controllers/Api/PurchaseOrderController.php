<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Stock;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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



    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_total' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'vat' => 'nullable|numeric',
            'products' => 'required|array',
            'products.*.item_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
        ]);

        try {
            // Create purchase order
            $purchase = new PurchaseOrder();
            $purchase->supplier_id = $request->supplier_id;
            $purchase->delivery_date = now()->addDays(7);
            $purchase->shipping_address = $request->shipping_address ?? 'N/A';
            $purchase->purchase_total = $request->purchase_total;

            $purchase->paid_amount = $request->paid_amount;
            $purchase->status_id = 1;
            $purchase->discount = $request->discount;
            $purchase->vat = $request->vat;
            $purchase->save();

            // Get the last inserted purchase ID
            $lastInsertedId = $purchase->id;

            // Save purchase details
            foreach ($request->products as $product) {
                PurchaseOrderDetail::create([
                    'purchase_id' => $lastInsertedId,
                    'product_id' => $product['item_id'],
                    'quantity' => $product['qty'],
                    'price' => $product['price'],
                    'discount' => $product['p_discount'],
                    'vat' => $product['p_vat'],
                ]);
                // $lastId = $lot->id;

                //Update stock table
                $stock = new Stock();
                $stock->product_id = $product['item_id'];
                $stock->qty = $product['qty'];
                $stock->transaction_type_id = 2;
                $stock->description = "purchase";
                $stock->created_at = date('Y-m-d H:i:s');
                $stock->updated_at = date('Y-m-d H:i:s');
                $stock->warehouse_id = 1;
                // $stock->lot_id = $lastId;
                // $stock = Stock::firstOrNew(['product_id' => $product['item_id']]);
                // $stock->quantity += $product['qty'];
                // $stock->save();
            }

            return response()->json(['message' => 'Purchase Order Created Successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */


    // public function store(Request $request)
    // {
    //     try {
    //         $purchase = new PurchaseOrder();
    //         $purchase->supplier_id = $request->supplier_id;
    //         $purchase->delivery_date = now()->addDays(7);
    //         $purchase->shipping_address = $request->shipping_address;
    //         $purchase->purchase_total = $request->purchase_total;
    //         $purchase->paid_amount = $request->paid_amount;
    //         // $purchase->description = $request->description;
    //         $purchase->status_id = 1;
    //         $purchase->discount = $request->discount;
    //         $purchase->vat = $request->vat;
    //         $purchase->created_at = date('Y-m-d H:i:s');
    //         date_default_timezone_set("Asia/Dhaka");
    //         $purchase->updated_at = date('Y-m-d H:i:s');
    //         date_default_timezone_set("Asia/Dhaka");
    //         $purchase->save();
    //         $lastInsertedId = $purchase->id;
    //         $purchase->created_at = date('Y-m-d H:i:s');

    //         $productsdata = $request->products;

    //         // Get the last inserted purchase ID
    //         $lastInsertedId = $purchase->id;

    //         foreach ($productsdata as $product) {
    //             PurchaseOrderDetail::create([
    //                 'purchase_id' => $lastInsertedId,
    //                 'product_id' => $product['item_id'],
    //                 'quantity' => $product['qty'],
    //                 'price' => $product['price'],
    //                 'vat' => "",
    //                 'discount' => $product['total_discount']

    //             ]);
    //             foreach ($productsdata as $product) {
    //                 Stock::create([
    //                     'product_id' => $product['item_id'],
    //                     'quantity' => $product['qty'] * (1),
    //                     'transaction_type_id' => 1,
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                     'updated_at' => date('Y-m-d H:i:s'),
    //                     'warehouse_id' => 1
    //                 ]);
    //             }
    //         }
    //         return response()->json(['success' => true, 'message' => 'Purchase order created successfully.']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }
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
