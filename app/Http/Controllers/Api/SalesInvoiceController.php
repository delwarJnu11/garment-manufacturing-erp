<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductLot;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceDetail;
use App\Models\Stock;
use Exception;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;



class SalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

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










    /**
     * Display the specified resource.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Create new sales invoice
            $salesInvoice = new SalesInvoice();
            $salesInvoice->customer_id = $request->customer_id;
            $salesInvoice->order_date = now();
            $salesInvoice->invoice_total = $request->invoice_total;
            $salesInvoice->paid_amount = $request->paid_amount;
            $salesInvoice->discount = $request->discount;
            $salesInvoice->vat = $request->vat;
            $salesInvoice->status = 'Pending';
            $salesInvoice->save();

            // Loop through products in the request and store invoice details
            $productsData = $request->products;
            foreach ($productsData as $product) {
                $salesInvoiceDetail = new SalesInvoiceDetail();
                $salesInvoiceDetail->sales_invoice_id = $salesInvoice->id;
                $salesInvoiceDetail->product_id = $product['product_id'];
                $salesInvoiceDetail->quantity = $product['qty'];
                $salesInvoiceDetail->unit_price = $product['price'];
                $salesInvoiceDetail->vat = $product['vat'];
                $salesInvoiceDetail->discount = $product['discount'];
                $salesInvoiceDetail->subtotal = $product['subtotal'];
                $salesInvoiceDetail->save();

                // Adjust stock and lot for each product in the invoice
                $remainingQty = $product['qty'];
                while ($remainingQty > 0) {
                    // Find available lot
                    $lot = ProductLot::where('product_id', $product['product_id'])
                        ->where('quantity', '>', 0)
                        ->orderBy('created_at', 'asc')
                        ->first();

                    if (!$lot) {
                        throw new Exception("Not enough stock for Product ID: " . $product['product_id']);
                    }

                    // Deduct from lot
                    $deductQty = min($lot->quantity, $remainingQty);
                    $lot->decrement('quantity', $deductQty);
                    $remainingQty -= $deductQty;

                    // Save stock record for deduction
                    $stock = new Stock();
                    $stock->product_id = $product['product_id'];
                    $stock->quantity = -$deductQty;
                    $stock->transaction_type_id = 2; // Sales transaction
                    $stock->remark = "Sales Invoice";
                    $stock->lot_id = $lot->id;
                    $stock->save();
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Invoice processed successfully',
                'invoice_id' => $salesInvoice->id,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
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
