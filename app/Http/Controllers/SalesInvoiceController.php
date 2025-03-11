<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\InvoiceStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductionWorkOrder;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;

class SalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales_invoices = SalesInvoice::with('buyer','invoice_status')->paginate(10);
        return view('pages.orders_&_buyers.sales_invoice.salesinvoice',compact('sales_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the orders related to production work orders and eager load the 'order' relation
        $orders = Order::with('buyer')->get();
        $orders = ProductionWorkOrder::with('order')
            ->whereIn('order_id', ProductionWorkOrder::pluck('order_id'))
            ->get()
            ->pluck('order')  // Pluck the related orders
            ->unique(); // Remove duplicates if any
    
        $buyers = Buyer::all();
        $invoice_status = InvoiceStatus::all();
    
        return view('pages.orders_&_buyers.sales_invoice.create', compact('buyers', 'orders'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesInvoice $SalesInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesInvoice $SalesInvoice)
    {
        //
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
