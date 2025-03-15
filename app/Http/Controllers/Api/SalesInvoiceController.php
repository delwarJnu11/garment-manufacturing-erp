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
            $saleInvoice = $request->invoiceData;

            $salesInvoice = new SalesInvoice();
            $salesInvoice->buyer_id = $saleInvoice['buyer_id'];
            $salesInvoice->sale_date = now();
            $salesInvoice->total_amount = $saleInvoice['invoice_total'];;
            $salesInvoice->paid_amount = $saleInvoice['paid_amount'] ?? 0;

            $salesInvoice->vat = $saleInvoice['vat'];;
            $salesInvoice->discount = $saleInvoice['discount'];;
            $salesInvoice->invoice_status_id = 1;  // Default invoice status
            $salesInvoice->remark = "";
            $salesInvoice->save();

            $last_id =  $salesInvoice->id;

            // Loop through the order's details and create invoice details
            //  $order = Order::with('orderDetails.product')->find($request->order_id); // Fetch order with product info

            if (! $last_id) {
                throw new Exception("sales Invoice not found for ID:");
            }
            foreach ($saleInvoice['products'] as $saleInvoiceDetail) {
                // Here, we get product_id directly from order_details
                $salesInvoiceDetail = new SalesInvoiceDetail();
                $salesInvoiceDetail->sales_invoice_id =  $last_id;
                $salesInvoiceDetail->order_id = $saleInvoice['order_id']; // Reference to the order
                $salesInvoiceDetail->qty = $saleInvoiceDetail['qty'];
                $salesInvoiceDetail->unit_price = $saleInvoiceDetail['unit_price'];
                $salesInvoiceDetail->vat = $saleInvoiceDetail['vat'] ?? 0;  // Assuming VAT is in order details
                $salesInvoiceDetail->percent_of_vat = $saleInvoiceDetail['vat_amount'] ?? 0;  // Assuming VAT is in order details
                $salesInvoiceDetail->discount = $saleInvoiceDetail['discount'];  // Assuming discount is in order details
                $salesInvoiceDetail->percent_of_discount = $saleInvoiceDetail['discount_amount'];  // Assuming discount is in order details
                $salesInvoiceDetail->save();

                $remainingQty = $saleInvoiceDetail['qty'];
                while ($remainingQty > 0) {
                    $lot = ProductLot::where('product_id', $saleInvoiceDetail['product_id'])
                        ->where('qty', '>', 0)
                        ->orderBy('created_at', 'asc')
                        ->first();
                    if (!$lot) {
                        throw new Exception('Not enough stock for product:' . $saleInvoiceDetail['product_name']);
                    }

                    $deductQty = min($lot->qty, $remainingQty);
                    $lot->decrement('qty', $deductQty);

                    $remainingQty -= $deductQty;

                    $stock = new Stock();
                    $stock->product_id = $saleInvoiceDetail['product_id'];
                    $stock->qty = $saleInvoiceDetail['qty'];
                    $stock->qty = -$deductQty;
                    $stock->transaction_type_id = 1;
                    $stock->lot_id = $lot->id;
                    $stock->save();
                }
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

            print_r($e->getMessage());
        }
    }
}
