<?php

namespace App\Http\Controllers;

use App\Models\InvoiceStatus;
use App\Models\InvSupplier;
use App\Models\Product;
use App\Models\ProductLot;
use App\Models\ProductVariant;
use App\Models\Purchase_status;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrders;
use App\Models\PurchaseStatus;
use App\Models\Warehouse;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $purchase_orders = PurchaseOrder::with(['inv_supplier', 'product_lot', 'purchase_status'])->where('status_id', '!=', 1)->paginate(8);

        return view('pages.purchase_&_supliers.purchase_order.purchaseConfirm', compact('purchase_orders'));
    }


    public function create()
    {

        $suppliers = InvSupplier::all();
        $lots = ProductLot::all();
        $statuses = InvoiceStatus::all();
        // Fetch only Product Variants with product_type_id = 1 (Raw Material)
        // $products = Product::whereHas('product_type', function ($query) {
        //     $query->where('id', 1)->orWhere('name', 'Raw Material');
        // })->get();
        $products = Product::where('product_type_id', 1)->get();
        return view('pages.purchase_&_supliers.purchase_order.create', compact('suppliers', 'lots', 'statuses', 'products'));
    }



    public function updateStatus(Request $request)
    {
        $request->validate([
            'selected_orders' => 'required|array',
            'statuses' => 'required|array'
        ]);

        foreach ($request->selected_orders as $orderId) {
            if (isset($request->statuses[$orderId]) && !empty($request->statuses[$orderId])) {
                $order = PurchaseOrder::find($orderId);

                // Check if the order is already confirmed (status_id = 2)
                if ($order && $order->status_id != 2) {
                    $order->update(['status_id' => $request->statuses[$orderId]]);
                }
            }
        }

        return redirect()->route('purchase.index')->with('success', 'Selected orders updated successfully.');
    }





    public function find_supplier(Request $request)
    {
        $supplier = InvSupplier::find($request->id);
        return response()->json(['supplier' => $supplier]);
    }

    public function find_product(Request $request)
    {
        $product = Product::find($request->id);
        return response()->json(['product' => $product]);
    }

    public function getInvoiceId()
    {
        // Get last invoice ID from purchase_order table
        $lastInvoice = DB::table('purchase_orders')->latest('id')->first();

        // Generate new Invoice ID
        $newInvoiceId = $lastInvoice ? $lastInvoice->id + 1 : 1;
        $formattedInvoiceId = "INV-" . str_pad($newInvoiceId, 6, "0", STR_PAD_LEFT);

        return response()->json(['invoice_id' => $formattedInvoiceId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder, $id)
    {

        $purchaseOrder = PurchaseOrder::with(['inv_supplier', 'purchaseDetails.product'])->findOrFail($id);
        return view('pages.purchase_&_supliers.purchase_order.show', compact('purchaseOrder'));
    }



    // Print Invoice
    public function print($id)
    {
        $invoice = PurchaseOrder::with(['purchaseDetails.product', 'inv_supplier'])->findOrFail($id);
        return view('invoice.print', compact('invoice'));
    }

    // Generate PDF
    public function generatePDF($id)
    {
        $invoice = PurchaseOrder::with(['purchaseDetails.product', 'inv_supplier'])->findOrFail($id);
        // Update this line to reflect the correct view path
        $pdf = FacadePdf::loadView('pages.purchase_&_supliers.purchase_order.pdf', compact('invoice'));

        return $pdf->download('invoice_' . $id . '.pdf');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrders) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrders)
    {
        //
    }
}
