<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
    //     // Begin a database transaction
    //     DB::beginTransaction();

        print_r($request->all());
        // Create a new sales invoice record
         $saleInvoice= $request->invoiceData;

        $salesInvoice = new SalesInvoice();
        $salesInvoice->buyer_id = $saleInvoice['buyer_id'];
        $salesInvoice->sale_date = now();
        $salesInvoice->total_amount =$saleInvoice['invoice_total'];;
        $salesInvoice->paid_amount = $saleInvoice['paid_amount'] ?? 0;
        $salesInvoice->discount = $saleInvoice['discount'];
        $salesInvoice->vat =$saleInvoice['vat'];;
        $salesInvoice->invoice_status_id = 1;  // Default invoice status
        $salesInvoice->remark ="";
        $salesInvoice->save();

       $last_id=  $salesInvoice->id;

        // Loop through the order's details and create invoice details
        //  $order = Order::with('orderDetails.product')->find($request->order_id); // Fetch order with product info

        if (! $last_id) {
            throw new Exception("sales Invoice not found for ID:");
        }


        

        foreach ($saleInvoice['products'] as $saleInvoiceDetail) {
            // Here, we get product_id directly from order_details
            $salesInvoiceDetail = new SalesInvoiceDetail();
            $salesInvoiceDetail->sales_invoice_id =  $last_id;
            $salesInvoiceDetail->order_id = $saleInvoice['order_id'];// Reference to the order
            $salesInvoiceDetail->qty = $saleInvoiceDetail['qty'];
            $salesInvoiceDetail->unit_price = $saleInvoiceDetail['unit_price'];  
            $salesInvoiceDetail->vat = $saleInvoiceDetail['vat'] ?? 0;  // Assuming VAT is in order details
            $salesInvoiceDetail->discount = 0;  // Assuming discount is in order details
            $salesInvoiceDetail->save();
        }



        // Commit the transaction if everything is successful
        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Invoice processed successfully',
            'invoice_id' => $salesInvoice->id,
        ]);

    } catch (Exception $e) {
    //     // Rollback the transaction if something goes wrong
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage(),
        ]);

        print_r( $e->getMessage());
    }
}

    
// public function store(Request $request)
// {
//     // try {
//         // DB::beginTransaction(); // Begin transaction
//         // print_r($request->all());
//         // Extract invoice data from request
//         // $saleInvoice = $request->invoiceData;

//         // // Create a new sales invoice
//         // $salesInvoice = new SalesInvoice();
//         // $salesInvoice->buyer_id = $saleInvoice['buyer_id'];
//         // $salesInvoice->sale_date = now();
//         // $salesInvoice->total_amount = $saleInvoice['invoice_total'];
//         // $salesInvoice->paid_amount = $saleInvoice['paid_amount'] ?? 0;
//         // $salesInvoice->discount = $saleInvoice['discount'];
//         // $salesInvoice->vat = $saleInvoice['vat'];
//         // $salesInvoice->invoice_status_id = 1;  // Default invoice status
//         // $salesInvoice->remark = "";
//         // $salesInvoice->created_at = now();
//         // $salesInvoice->updated_at = now();
//         // $salesInvoice->save();

//         // $last_id = $salesInvoice->id;

//         // if (!$last_id) {
//         //     throw new Exception("Sales Invoice not found for ID:");
//         // }

//         // $cogs = 0;
//         // $sale_price = 0;

//         // Process each product in the sales invoice
//         // foreach ($saleInvoice['products'] as $product) {
//         //     // Create sales invoice detail
//         //     $salesInvoiceDetail = new SalesInvoiceDetail();
//         //     $salesInvoiceDetail->sales_invoice_id = $last_id;
//         //     $salesInvoiceDetail->order_id = $saleInvoice['order_id']; // Reference to the order
//         //     $salesInvoiceDetail->product_id = $product['product_id'];
//         //     $salesInvoiceDetail->qty = $product['qty'];
//         //     $salesInvoiceDetail->unit_price = $product['unit_price'];  
//         //     $salesInvoiceDetail->vat = $product['vat'] ?? 0;
//         //     $salesInvoiceDetail->discount = $product['discount'] ?? 0;
//         //     $salesInvoiceDetail->created_at = now();
//         //     $salesInvoiceDetail->updated_at = now();
//         //     $salesInvoiceDetail->save();

//         //     // Stock & Lot Update
//         //     $remainingQty = $product['qty'];
//         //     $sale_price += $product['unit_price'] * $product['qty'];

//         //     while ($remainingQty > 0) {
//         //         $lot = ProductLot::where('product_id', $product['product_id'])
//         //             ->where('quantity', '>', 0)
//         //             ->orderBy('created_at', 'asc')
//         //             ->first();

//         //         if (!$lot) {
//         //             throw new Exception("Not enough stock for Product ID: " . $product['product_id']);
//         //         }

//         //         // Deduct from the lot
//         //         $deductQty = min($lot->quantity, $remainingQty);
//         //         $lot->decrement('quantity', $deductQty);
//         //         $remainingQty -= $deductQty;
//         //         $cogs += $lot->cost_price * $deductQty;

//         //         // Stock record update
//         //         $stock = new Stock();
//         //         $stock->product_id = $product['product_id'];
//         //         $stock->qty = -$deductQty;
//         //         $stock->transaction_type_id = 2; // Sales transaction
//         //         $stock->remark = "Sales Invoice - Invoice ID: " . $salesInvoice->id;
//         //         $stock->created_at = now();
//         //         $stock->updated_at = now();
//         //         $stock->warehouse_id = 1;
//         //         $stock->lot_id = $lot->id;
//         //         $stock->save();
//         //     }
//         // }

        

//     //     DB::commit(); // Commit transaction if everything is successful

//     //     return response()->json([
//     //         'success' => true,
//     //         'message' => 'Invoice processed successfully',
//     //         'invoice_id' => $salesInvoice->id,
//     //     ]);

//     // } catch (\Throwable $th) {
//     //     DB::rollBack(); // Rollback transaction if something goes wrong
//     //     return response()->json([
//     //         'success' => false,
//     //         'message' => 'Error: ' . $th->getMessage(),
//     //     ]);
//     // }
// }



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
