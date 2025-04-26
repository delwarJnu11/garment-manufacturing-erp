<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Uom;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('product_type', 'category_type', 'size', 'uom')->paginate(10);
        return response()->json([
            "products" => $products
        ]);
    }




    public function create()
    {
        return response()->json([
            'product_types' => ProductType::all(),
            'sizes' => Size::all(),
            'uoms' => Uom::all(),
            'categories' => Category::all(),
            'rawMaterialCategories' => Category::where('is_raw_material', 1)->get(),
            'finishedGoodsCategories' => Category::where('is_raw_material', 0)->get(),
        ]);
    }



    public function store(Request $request)
    {
        // \Log::info($request->all());
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'sku' => 'required|string|max:255|unique:products,sku',
        //     'product_type_id' => 'required|integer|exists:product_types,id',
        //     'category_type_id' => 'required|integer|exists:categories,id',
        //     'qty' => 'required|integer|min:0',
        //     'unit_price' => 'required|numeric|min:0',
        //     'uom_id' => 'required|integer|exists:uoms,id',
        //     'size_id' => 'required|integer|exists:sizes,id',
        // ]);

        $product = new Product();
        $product->name = $request['name'];
        $product->sku = $request['sku'];
        $product->product_type_id = $request['product_type_id'];
        $product->category_type_id = $request['category_type_id'];
        $product->qty = $request['qty'];
        $product->unit_price = $request['unit_price'];
        $product->uom_id = $request['uom_id'];
        $product->size_id = $request['size_id'];

        $product->save();

        return response()->json(['message' => 'Product created successfully!'], 201);
    }


    //stock api
    public function stock()
    {
        $stocks = Stock::with('product', 'transactionType', 'lot.warehouse')->paginate(8);
        // dd($stocks->toArray()['data']);
        return response()->json(['stocks' => $stocks]);
    }
}
