<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductLot;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Stock;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
            DB::beginTransaction();

            // Log incoming request for debugging
            Log::info('Received Purchase Data:', $request->all());

            // Decode JSON products if necessary
            $products = is_string($request->products) ? json_decode($request->products, true) : $request->products;

            // Validate the request
            $validated = $request->validate([
                'supplier_id' => 'required|exists:inv_suppliers,id',
                'total_amount' => 'required|numeric',
                'paid_amount' => 'required|numeric',
                'discount' => 'sometimes|numeric',
                'vat' => 'sometimes|numeric',
                'products' => 'required|array',
                'products.*.item_id' => 'required|exists:products,id',
                'products.*.qty' => 'required|numeric|min:1',
                'products.*.price' => 'required|numeric|min:0',
                // 'products.*.lot_id' => 'nullable|exists:product_lots,id',
                'products.*.total_discount' => 'sometimes|numeric'
            ]);

            Log::info('Validation Passed:', $validated);


            $purchaseDate = now();
            $pendingAmount = $request->total_amount - $request->paid_amount;

            $purchase = PurchaseOrder::create([
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $purchaseDate,
                'delivery_date' => now()->addDays(7),
                'shipping_address' => "123 Factory Road, City, Country",
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->paid_amount,
                'pending_amount' => $pendingAmount,
                'status_id' => 1,
                'discount' => $request->discount ?? 0,
                'vat' => $request->vat ?? 0,
            ]);


            Log::info('Purchase Order Created:', ['id' => $purchase->id]);

            // Insert Purchase Order Details & Update Stock
            foreach ($products as $product) {
                PurchaseOrderDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product['item_id'],
                    'quantity' => $product['qty'],
                    'lot_id' =>  1,
                    'price' => $product['price'],
                    '%_of_discount' => $product['p_discount'],
                    'vat' =>  $product['total_vat'] ?? 0,
                    '%_of_vat' =>  $product['p_vat'] ?? 0,
                    'discount' => $product['total_discount'] ?? 0
                ]);

                $lot = ProductLot::create([
                    'product_id' => $product['item_id'],
                    'qty' => $product['qty'],
                    'cost_price' => $product['price'],
                    'sales_price' => $product['sales_price'] ?? 0.0,
                    'warehouse_id' => 1,
                    'transaction_type_id' => 3,
                    'description' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if (!$lot) {
                    throw new \Exception('Failed to create product_lot id');
                }

                // Assign last inserted lot ID
                $lastId = $lot->id;

                Stock::create([
                    'product_id' => $product['item_id'],
                    'qty' => $product['qty'],
                    'transaction_type_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                    // 'wearhouse_id' => 1,
                    'lot_id' => $lastId,
                ]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Purchase order created successfully.',
                'purchase_order_id' => $purchase->id,
                'redirect_url' => route('purchaseState.index'),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error Creating Purchase Order: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Server Error',
                'error' => $e->getMessage()  // Show actual error for debugging
            ], 500);
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
