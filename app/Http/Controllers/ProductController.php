<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Size;
use App\Models\Uom;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('product_type', 'category_type', 'size', 'uom')->paginate(4);
        return view('pages.inventory.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_types = ProductType::all();
        $sizes = Size::all();
        $uoms = Uom::all();
        $categories = Category::all();

        // filter the server-side
        // For Raw Materials (product_type = 1)
        $rawMaterialCategories = Category::where('is_raw_material', 1)->get();
        // For Finished Goods (product_type = 2)
        $finishedGoodsCategories = Category::where('is_raw_material', 0)->get();
        return view('pages.inventory.products.create', compact('product_types', 'sizes', 'uoms', 'rawMaterialCategories', 'finishedGoodsCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|min:5",
            'product_type_id' => "required",
            'category_type_id' => "required",
            'size' => "nullable",
            'sku' => "required|min:4",
            'qty' => "required",
            'uom_id' => "required",
            'unit_price' => "required",

        ]);

        Product::create([
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
            'category_type_id' => $request->category_type_id,
            'size' => $request->size,
            'sku' => $request->sku,
            'qty' => $request->qty,
            'uom_id' => $request->uom_id,
            'unit_price' => $request->unit_price,
        ]);
        return redirect('stock/products')->with('success', 'product variants create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $Product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $Product)
    {
        //
    }
}
