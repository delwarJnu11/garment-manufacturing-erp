<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\InvoiceStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductionWorkOrder;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
   

    public function create()
{
    // Fetch sales invoices with nested relationships (Buyer, InvoiceStatus, and SalesInvoiceDetail)
    
    $salesInvoices = SalesInvoice::with([
        'buyer',
        'invoice_status',
        'salesInvoiceDetail' => function ($query) {
            $query->with([
                'productionWorkOrder' => function ($query) {
                    $query->with('order');
                }
            ]);
        }
    ])->get();
  
    // Fetch orders with buyer and order details (nested relationship)
    $orders = Order::with('buyer', 'orderDetails')->get();
  
    
    $buyers = Buyer::all();
  
   
    $invoiceStatus = InvoiceStatus::all();
  
    // Debugging log to check loaded data
    Log::info("Create Sales Invoice Page Data", [
        'buyers' => $buyers,
        'salesInvoices' => $salesInvoices,
        'orders' => $orders,
    ]);
  
    // Return the view with the necessary data
    return view('pages.orders_&_buyers.sales_invoice.create', compact('buyers', 'salesInvoices', 'orders', 'invoiceStatus'));
}

    
    public function find_buyer(Request $request)
    {
        $buyer = Buyer::find($request->id);
        return response()->json(['buyer' => $buyer]);
    }



    


    public function find_order(Request $request)
    {
        $order = Order::find($request->id);
        return response()->json(['order' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
         $order_id= 4;    
          
         $order= Order::where('id', $order_id)->with(['orderDetails', 'bom', 'bom.bomDetails'])->get();

         echo json_encode($order);
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesInvoice $SalesInvoice)
    {

    }

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
