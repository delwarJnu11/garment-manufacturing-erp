<?php

namespace App\Http\Controllers;

use App\Models\inv_suppliers;
use App\Models\ProductLot;
use App\Models\ProductVariant;
use App\Models\Purchase_status;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrders;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $purchase_orders = PurchaseOrder::with(['inv_supplier', 'product_lot', 'purchase_status', 'product_variant'])->paginate(5);
        $purchase_orders = PurchaseOrder::with(['product_variant', 'inv_supplier', 'product_lot', 'purchase_status'])->paginate(10);;

        return view('pages.purchase_&_supliers.purchase_order.index', compact('purchase_orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $suppliers = inv_suppliers::all();
    //     $lots = ProductLot::all();
    //     $product_variants = ProductVariant::whereHas('productType', function ($query) {
    //         $query->where('id', 1)->orWhere('name', 'Raw Material');
    //     })->get();
    //     // $lots = ProductLot::all();
    //     $statuses = Purchase_status::all();

    //     return view('pages.purchase_&_supliers.purchase_order.create', compact('suppliers', 'lots', 'statuses', 'product_variants'));
    // }
    public function create()
    {
        $suppliers = inv_suppliers::all();
        $lots = ProductLot::all();
        $statuses = Purchase_status::all();

        // Fetch only Product Variants with product_type_id = 1 (Raw Material)
        $product_variants = ProductVariant::whereHas('product_type', function ($query) {
            $query->where('id', 1)->orWhere('name', 'Raw Material');
        })->get();

        return view('pages.purchase_&_supliers.purchase_order.create', compact('suppliers', 'lots', 'statuses', 'product_variants'));
    }


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
    public function findSupplier(Request $request)
    {
        $supplier = inv_suppliers::find($request->id);
        return response()->json(['supplier' => $supplier]);
    }
    public function findRawMaterial(Request $request)
    {
        $product = ProductVariant::find($request->id);
        return response()->json(['product' => $product]);
    }
}
