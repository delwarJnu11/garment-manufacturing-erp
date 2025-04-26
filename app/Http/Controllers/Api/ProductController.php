<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductLot;
use App\Models\ProductType;
use App\Models\Size;
use App\Models\Stock;
use App\Models\TransactionType;
use App\Models\Uom;
use App\Models\Wastage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    // Store Wastage Product
    public function storeProduct(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_name' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
            'profit_rate' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $sizeId = OrderDetail::where('order_id', $request->order_id)->first()?->size_id;
            $uomId = OrderDetail::where('order_id', $request->order_id)->first()?->uom_id;
            $productTypeId = ProductType::where('name', $request->wastage_type)->first()?->id;
            $sku = "WST-" . time();
            $unitPrice = $request->unit_price + ($request->profit_rate * $request->unit_price) / 100;

            Product::create([
                'name' => $request->product_name,
                'sku' => $sku,
                'product_type_id' => $productTypeId,
                'qty' => $request->quantity,
                'unit_price' => $unitPrice,
                'uom_id' => $uomId,
                'size_id' => $sizeId,
            ]);

            $productId = Product::where('name', $request->product_name)->first()?->id;
            // dd($productId);

            $transactionTypeId = TransactionType::where('name', 'Wastage products')->first()?->id;

            $productLot = ProductLot::create([
                "product_id" => $productId,
                "qty" => $request->quantity,
                "cost_price" => $request->unit_price,
                "sales_price" => $unitPrice,
                "transaction_type_id" => $transactionTypeId,
                "warehouse_id" => $request->warehouse_id,
                "description" => "Wastage Product",
            ]);

            $lastId = $productLot->id;

            Stock::create([
                "product_id" => $productId,
                'lot_id' => $lastId,
                'transaction_type_id' => $transactionTypeId,
                "qty" => $request->quantity,
                'total_value' => $request->quantity * $request->unit_price,
            ]);



            $wastage = Wastage::find($request->wastage_id);
            $wastage->is_sellable = true;
            $wastage->save();

            DB::commit();

            return response()->json(['message' => 'Wastage sold successfully!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
