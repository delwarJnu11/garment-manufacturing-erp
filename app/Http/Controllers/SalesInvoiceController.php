<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\InvoiceStatus;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
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
        $sales_invoices = SalesInvoice::with('buyer', 'salesInvoiceDetails.order',  'invoice_status')->paginate(10);
        // dd($sales_invoices);
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
            $bom_detail = $bom->bomDetails->where('size_id', $size_id)->first();

            // Skip if no matching BOM detail for this size
            if (!$bom_detail) {
                continue;
            }
            // Extract unit price from BOM detail
            $unit_price_bom = $bom_detail->unit_price;
            $total_quantity = $detail->qty;

            // Calculate cost per unit (overhead + labor) for the specific quantity
            $cost_per_unit = ($overhead_cost + $labour_cost) / max($total_quantity, 1);

            // markup 40% profit
            $final_unit_price = ($unit_price_bom + $cost_per_unit) * 1.4;

            // Prepare order details for response
            $order_details[] = [
                'product_name' => $detail->product->name,
                'product_id' => $detail->product->id,
                'size' => $size_name, // Use size name here
                'qty' => $total_quantity,
                'unit_price' => round($final_unit_price, 2)
            ];
        }

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


    public function getInvoiceId()
    {
        try {
            // Get the last invoice ID from the sales_invoices table
            $lastInvoice = DB::table('sales_invoices')->latest('id')->first();

            // Generate new Invoice ID
            $newInvoiceId = $lastInvoice ? $lastInvoice->id + 1 : 1;
            $formattedInvoiceId = "INV-" . str_pad($newInvoiceId, 6, "0", STR_PAD_LEFT);

            // Get the current date
            $currentDate = Carbon::now()->toDateString();

            return response()->json([
                'invoice_id' => $formattedInvoiceId,
                'sale_date' => $currentDate,
            ]);
        } catch (\Exception $e) {

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

    // public function show($id)
    // {
    //     $salesInvoice = SalesInvoice::with(['buyer', 'salesInvoiceDetail.orderDetails.product'])->findOrFail($id);


    //     return view('pages.orders_&_buyers.sales_invoice.show', compact('salesInvoice'));
    // }

//     public function show($id, Order $order)
//     {
//         // $salesInvoice = SalesInvoice::with([
//         //     'buyer',
//         //     'salesInvoiceDetails.order.orderDetails.product',
//         //     'salesInvoiceDetails.order.orderDetails.size'
//         // ])->findOrFail($id);

//         $salesInvoice = OrderDetail::where('order_id','order.buyer')->with('product','size','uom','color')->get()->groupBy('size_id');
        
//         return view('pages.orders_&_buyers.sales_invoice.show', compact('salesInvoice'));
    
// }

public function show($id)
{
    $orderDetails = OrderDetail::where('order_id', $id)
        ->with(['product', 'size', 'uom', 'color'])
        ->get()
        ->groupBy('size_id');

    return response()->json([
        'orderDetailsGrouped' => $orderDetails
    ]);
}


    public function invoicePending()
    {
        $salesInvoices = SalesInvoice::with('invoice_status', 'buyer', 'salesInvoiceDetails.order')->get();
        $invoiceStatuses = InvoiceStatus::all();

        return view('pages.orders_&_Buyers.sales_invoice.salesPending', compact('salesInvoices', 'invoiceStatuses'));
    }

    public function updateInvoiceStatus(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'invoice_status_id' => 'required|exists:invoice_statuses,id', // Ensure the status exists
        ]);

        // Find the invoice
        $salesInvoice = SalesInvoice::findOrFail($id);

        // Update the invoice status
        $salesInvoice->invoice_status_id = $request->invoice_status_id;
        $salesInvoice->save();

        return response()->json(['success' => true, 'message' => 'Invoice status updated successfully']);
    }
    public function generateSalesPDF($invoiceId)
    {
        // Fetch sales invoice data (make sure to replace this with actual data fetching logic)
        // $salesInvoice = SalesInvoice::findOrFail($invoiceId);
        $salesInvoice = SalesInvoice::with([
            'buyer',
            'salesInvoiceDetails.order.orderDetails.product',
            'salesInvoiceDetails.order.orderDetails.size'
        ])->findOrFail($invoiceId);

        // Pass the data to the view
        $pdf = FacadePdf::loadView('pages.orders_&_Buyers.sales_invoice.pdf', compact('salesInvoice'));

        // Option 1: Download the PDF
        return $pdf->download('invoice_' . $salesInvoice->id . '.pdf');
    }

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
    public function destroy(SalesInvoice $SalesInvoice) {}


//     public function show2(Request $request, Order $order)
//     {
//         $buyer = $order->buyer;

//         $orderDetails = OrderDetail::where('order_id', $order->id)
//             ->with('product', 'size', 'color', 'uom')
//             ->get();

//         // Get BOM for this order
//         $bom = $order->bom;
//         // Initialize size-based costs
//         $sizeData = [];

//         if ($bom) {
//             // Fetch BOM details and join with Product table
//             $bomDetails = $bom->bomDetails()
//                 ->select('size_id', 'quantity_used', 'unit_price', 'wastage')
//                 ->get()
//                 ->groupBy('size_id');



//         //     // Fetch dynamic operating costs from BOM
//         //     $operatingCost = $bom->utility_cost + $bom->labour_cost + $bom->overhead_cost;

//         //     // Calculate material costs per size
//         //     foreach ($bomDetails as $sizeId => $materials) {
//         //         $materialCost = $materials->sum(function ($material) {
//         //             $wastageCost = ($material->quantity_used * ($material->wastage / 100)) * $material->unit_price;
//         //             return ceil(($material->quantity_used * $material->unit_price) + $wastageCost);
//         //         });

//         //         $sizeData[$sizeId] = [
//         //             'material_cost' => $materialCost,
//         //             'operating_cost' => $operatingCost,
//         //         ];
//         //     }
//         // }
//         // // Check if PDF download is requested
//         // if ($request->has('download')) {
//         //     $pdf = Pdf::loadView('pages.orders_&_buyers.order.orderpdf', compact('order', 'buyer', 'orderDetails', 'sizeData'))
//         //         ->setPaper('a4', 'portrait');

//         //     return $pdf->download($order->order_number . '.pdf');
//         // }

//         return view('pages.orders_&_buyers.order.show', compact('order', 'buyer', 'orderDetails', 'sizeData'));
//     }
// }
}



