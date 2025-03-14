<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\InvoiceStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class SalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales_invoices = SalesInvoice::with('buyer', 'invoice_status')->paginate(10);
        return view('pages.orders_&_buyers.sales_invoice.salesinvoice', compact('sales_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Get all orders with their buyer and order details
        $orders = Order::with('buyer', 'orderDetails')->get();

        // Get all buyers and invoice statuses
        $buyers = Buyer::all();
        $invoiceStatus = InvoiceStatus::all();

        return view('pages.orders_&_Buyers.sales_invoice.create', compact('buyers', 'orders', 'invoiceStatus'));
    }

    public function find_order(Request $request)
    {
        $order_id = $request->order_id;

        // Find the order with details and BOM
        $order = Order::with('orderDetails.product', 'bom.bomDetails', 'orderDetails.size')->find($order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $bom = $order->bom;

        if (!$bom) {
            return response()->json(['error' => 'BOM not found for this order'], 404);
        }

        $overhead_cost = $bom->overhead_cost;
        $labour_cost = $bom->labour_cost;

        $order_details = [];

        foreach ($order->orderDetails as $detail) {
            // Ensure we are working with size name and size ID correctly
            $size_name = $detail->size ? $detail->size->name : 'No size';
            $size_id = $detail->size ? $detail->size->id : null;

            // Find the BOM detail based on size_id and color_id (if relevant)
            $bom_detail = $bom->bomDetails->where('size_id', $size_id)->first(); // Use size_id for comparison

            // Skip if no matching BOM detail for this size
            if (!$bom_detail) {
                continue;
            }

            // Extract unit price from BOM detail
            $unit_price_bom = $bom_detail->unit_price;
            $total_quantity = $detail->qty; // Quantity of this size in order

            // Calculate cost per unit (overhead + labor) for the specific quantity
            $cost_per_unit = ($overhead_cost + $labour_cost) / max($total_quantity, 1);

            // Calculate final unit price, applying a markup factor of 1.4
            $final_unit_price = ($unit_price_bom + $cost_per_unit) * 1.4;

            // Prepare order details for response
            $order_details[] = [

                'product_name' => $detail->product->name,
                'product_id' => $detail->product->id,
                'size' => $size_name, // Use size name here
                'qty' => $total_quantity,
                'unit_price' => round($final_unit_price, 2) // Ensure the price is rounded to 2 decimal places
            ];
        }

        // Return the order details in response
        return response()->json(['order_details' => $order_details]);
    }



    public function find_buyer(Request $request)
    {
        $buyer = Buyer::find($request->id);

        if (!$buyer) {
            return response()->json(['error' => 'Buyer not found'], 404);
        }

        return response()->json(['buyer' => $buyer]);
    }


    // public function createInvoice(Request $request)
    // {
    //     // Get today's date
    //     $invoiceDate = Carbon::now()->toDateString();

    //     // Get the last invoice ID and increment it
    //     $lastInvoice = SalesInvoice::latest()->first();
    //     $nextInvoiceId = $lastInvoice ? $lastInvoice->id + 1 : 1;  // If no previous invoice, start from 1

    //     // Return the view with the necessary data
    //     return view('pages.orders_&_Buyers.sales_invoice.create', compact('invoiceDate', 'lastInvoice', 'nextInvoiceId'));
    // }
    public function getInvoiceId()
    {
        try {
            // Get the last invoice ID from the sales_invoices table
            $lastInvoice = DB::table('sales_invoices')->latest('id')->first();

            // Generate new Invoice ID
            $newInvoiceId = $lastInvoice ? $lastInvoice->id + 1 : 1;
            $formattedInvoiceId = "INV-" . str_pad($newInvoiceId, 6, "0", STR_PAD_LEFT);

            // Get the current date
            $currentDate = Carbon::now()->toDateString();  // e.g., "2025-03-12"

            return response()->json([
                'invoice_id' => $formattedInvoiceId,
                'sale_date' => $currentDate,
            ]);
        } catch (\Exception $e) {
            // Log the error and return a response
            Log::error("Error fetching invoice ID: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $order_id = 2;
        $order = Order::where('id', $order_id)->with(['orderDetails', 'bom', 'bom.bomDetails'])->get();
        echo json_encode($order);
    }

    // public function show(Request $request)
    // {
    //     $order_id = $request->order_id; // Get selected order ID from request

    //     $order = Order::where('id', $order_id)
    //         ->with([
    //             'orderDetails.product', // Include product name
    //             'bom'
    //         ])
    //         ->first();

    //     if (!$order) {
    //         return response()->json(['error' => 'No order found'], 404);
    //     }

    //     // Extract required data
    //     $products = $order->orderDetails->map(function ($detail) {
    //         return [
    //             'product_name' => $detail->product->name, // Get product name
    //             'qty' => $detail->qty // Get quantity
    //         ];
    //     });

    //     return response()->json([
    //         'products' => $products,
    //         'total_cost' => $order->bom->total_cost ?? 0 // Get total cost from BOM
    //     ]);
    // }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesInvoice $SalesInvoice) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesInvoice $SalesInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesInvoice $SalesInvoice)
    {
        //
    }
}

 // public function create()
    // {
    //     // Fetch sales invoices with nested relationships (Buyer, InvoiceStatus, and SalesInvoiceDetail)
    //     $salesInvoices = SalesInvoice::with([
    //         'buyer',
    //         'invoice_status',
    //         'salesInvoiceDetail' => function ($query) {
    //             $query->with([
    //                 'order' => function ($query) {
    //                     $query->with('orderDetails');
    //                 }
    //             ]);
    //         }
    //     ])->get();

    //     // Fetch orders with buyer and order details (nested relationship)
    //     $orders = Order::with('buyer', 'orderDetails')->get();

    //     $buyers = Buyer::all();

    //     $invoiceStatus = InvoiceStatus::all();

    //     // Debugging log to check loaded data
    //     Log::info("Create Sales Invoice Page Data", [
    //         'buyers' => $buyers,
    //         'salesInvoices' => $salesInvoices,
    //         'orders' => $orders,
    //     ]);

    //     // Return the view with the necessary data
    //     return view('pages.orders_&_buyers.sales_invoice.create', compact('buyers', 'salesInvoices', 'orders', 'invoiceStatus'));
    // }
