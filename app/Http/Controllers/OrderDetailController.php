<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Order;
use App\Models\orderDetail;
use App\Models\Product;
use App\Models\Size;
use App\Models\Uom;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderDetails = OrderDetail::with(['product', 'order', 'size', 'color', 'uom'])->paginate(4);
        return view('pages.orders_&_buyers.order_details.index', compact('orderDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Product Type Id 1 = Raw Materials
        //Product Type Id 2 = Finished Goods
        $products = Product::where('product_type_id', 2)->get();
        $orders = Order::all();
        $sizes = Size::all();
        $colors = Color::all();
        $uoms = Uom::all();
        return view('pages.orders_&_buyers.order_details.create', compact('products', 'orders', 'sizes', 'colors', 'uoms'));
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
    public function show(orderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(orderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, orderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(orderDetail $orderDetail)
    {
        //
    }
}
