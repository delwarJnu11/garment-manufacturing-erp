<?php

namespace App\Http\Controllers;

use App\Models\InvSupplier;
use App\Models\Product;
use App\Models\ProductLot;
use App\Models\ProductVariant;
use App\Models\Purchase_status;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrders;
use App\Models\PurchaseStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $purchase_orders = PurchaseOrder::with(['inv_supplier', 'product_lot', 'purchase_status'])->paginate(10);

        return view('pages.purchase_&_supliers.purchase_order.purchaseConfirm', compact('purchase_orders'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'selected_orders' => 'required|array',
            'statuses' => 'required|array'
        ]);
    
        foreach ($request->selected_orders as $orderId) {
            if (isset($request->statuses[$orderId]) && !empty($request->statuses[$orderId])) {
                PurchaseOrder::where('id', $orderId)
                    ->update(['status_id' => $request->statuses[$orderId]]);
            }
        }
    
        return redirect()->route('purchase.index')->with('success', 'Selected orders updated successfully.');
    }
    

    public function purchaseConfirm()
    {
        $confirmedOrders = PurchaseOrder::with(['inv_supplier', 'product_lot', 'purchase_status'])
            ->where('status_id', 2) // Assuming '2' is the ID for 'Confirmed'
            ->paginate(10);

        return view('pages.purchase_&_supliers.purchase_order.purchaseConfirm', compact('confirmedOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {


    //     $suppliers = InvSupplier::all();
    //     // dd($suppliers);
    //     $product_variants = ProductVariant::all();
    //     return view('pages.purchase_&_supliers.purchase_order.create', compact('suppliers', 'product_variants'));
    // }


    public function create()
    {
        $suppliers = InvSupplier::all();
        $lots = ProductLot::all();
        $statuses = PurchaseStatus::all();
        // Fetch only Product Variants with product_type_id = 1 (Raw Material)
        $products = Product::whereHas('product_type', function ($query) {
            $query->where('id', 1)->orWhere('name', 'Raw Material');
        })->get();
        return view('pages.purchase_&_supliers.purchase_order.create', compact('suppliers', 'lots', 'statuses', 'products'));
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





    // public function create()
    // {
    //     $suppliers = inv_suppliers::all();
    //     $lots = ProductLot::all();
    //     $statuses = Purchase_status::all();
    //     $product_variants = ProductVariant::where('product_type_id', 1)->get();

    //     dd($suppliers, $lots, $statuses, $product_variants);
    // }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'supplier_id' => 'required',
        //     'product_variant_id' => 'required',
        //     'product_lot_id' => 'required',
        //     'status_id' => 'required',
        //     'delivery_date' => 'required',
        //     'shipping_address' => 'required',
        //     'description' => 'nullable',
        // ]);


        // $order = new PurchaseOrder();
        // $order->supplier_id = $request->supplier_id;
        // $order->product_variant_id = $request->product_variant_id;
        // $order->lot_id = $request->product_lot_id;
        // $order->status_id = $request->status_id;
        // $order->delivery_date = $request->delivery_date;
        // $order->shipping_address = $request->shipping_address;
        // $order->description = $request->description;
        // $order->save();


        // return redirect('purchase_orders')->with('success', 'Purchase Order Created Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrders)
    {
        //
    }

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
