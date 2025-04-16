<?php

namespace App\Http\Controllers\Api\vue;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $productsQuery = Product::with('product_type', 'category_type', 'size', 'uom');

            if ($request->search) {
                $search = $request->search;
                $productsQuery->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('id', 'like', '%' . $search . '%');
                    // ->orWhere('sku', 'like', '%' . $search . '%');
                });
            }

            $products = $productsQuery->paginate(5);

            return response()->json([
                'success' => true,
                'message' => 'Successfully fetched products',
                'products' => $products
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|min:4",
            'category_type_id' => "required|integer",
            'product_type_id' => "required|integer",
            'size_id' => "required|integer",
            'sku' => "required|min:3",
            'qty' => "required|integer",
            'uom_id' => "required|integer",
            'unit_price' => "required|numeric",
        ]);
        try {
            Product::create([
                'name' => $request->name,
                'category_type_id' => $request->category_type_id,
                'product_type_id' => $request->product_type_id,
                'size_id' => $request->size_id,
                'sku' => $request->sku,
                'qty' => $request->qty,
                'uom_id' => $request->uom_id,
                'unit_price' => $request->unit_price,
            ]);
            return response()->json(['message' => 'products create successfully'], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => $th->getMessage()], 500);
            //throw $th;
        }
    }


    public function productType()
    {
        $productTypes = ProductType::all();
        return response()->json([
            'productTypes' => $productTypes
        ]);
    }
    public function warehouse()
    {
        $warehouses = Warehouse::all();
        return response()->json([
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
