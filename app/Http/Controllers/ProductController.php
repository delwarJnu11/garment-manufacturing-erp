<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Product;
use App\Models\Uom;
use App\Models\Valuation_methods;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('pages.inventory.purchase.products.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $raw_material_categories = Category::where('is_raw_material', 1)->get();
        $finished_categories = Category::where('is_raw_material', 0)->get();
        $uoms = Uom::all();
        $valuation_methods = Valuation_methods::all();

        return view('pages.inventory.purchase.products.create', compact('raw_material_categories', 'finished_categories', 'uoms', 'valuation_methods'));
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'sku' => 'required|string|max:100|unique:products,sku',
    //         'description' => 'nullable|string',
    //         'unit_price' => 'required|numeric|min:0',
    //         'offer_price' => 'nullable|numeric|min:0',
    //         'weight' => 'nullable|numeric|min:0',
    //         'size_id' => 'nullable|integer',
    //         'is_raw_material' => 'required|in:0,1',
    //         'barcode' => 'nullable|string|max:255',
    //         'rfid' => 'nullable|string|max:255',
    //         'category_id' => 'required|exists:categories,id',
    //         'uom_id' => 'nullable|exists:uoms,id',
    //         'valuation_method_id' => 'required|exists:valuation_methods,id',
    //         'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

    //     ]);


    //     // Handle file upload
    //     // Handle file upload
    //     if ($request->hasFile('photo')) {
    //         $file = $request->file('photo');
    //         $fileName = time() . '_' . $file->getClientOriginalName(); // Ensure unique name
    //         $file->move(public_path('uploads/products'), $fileName);
    //         $photoPath = 'uploads/products/' . $fileName; // Store relative path in DB
    //     } else {
    //         $photoPath = null;
    //     }

    //     // Save to the database
    //     $product = new Product();
    //     $product->name = $request->name;
    //     $product->sku = $request->sku;
    //     $product->description = $request->description;
    //     $product->unit_price = $request->unit_price;
    //     $product->offer_price = $request->offer_price;
    //     $product->weight = $request->weight;
    //     $product->size_id = $request->size_id;
    //     $product->is_raw_material = $request->is_raw_material;
    //     $product->barcode = $request->barcode;
    //     $product->rfid = $request->rfid;
    //     $product->category_id = $request->category_id;
    //     $product->uom_id = $request->uom_id;
    //     $product->valuation_method_id = $request->valuation_method_id;
    //     $product->photo = $photoPath; // Store the file path in DB

    //     Log::info($request->all());


    //     // $product->save();
    //     // return redirect('products')->with('success', 'Product added successfully!');
    //     // return redirect()->route('products.product')->with('success', 'Product added successfully!');
    // }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
            'offer_price' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'size_id' => 'nullable|integer',
            'is_raw_material' => 'required|in:0,1',
            'barcode' => 'nullable|string|max:255',
            'rfid' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'uom_id' => 'nullable|exists:uoms,id',
            'valuation_method_id' => 'required|exists:valuation_methods,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $fileName);
            $photoPath = 'uploads/products/' . $fileName;
        } else {
            $photoPath = null;
        }

        // Save product
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->offer_price = $request->offer_price;
        $product->weight = $request->weight;
        $product->size_id = $request->size_id;
        $product->is_raw_material = $request->is_raw_material;
        $product->barcode = $request->barcode;
        $product->rfid = $request->rfid;
        $product->category_id = $request->category_id;
        $product->uom_id = $request->uom_id;
        $product->valuation_method_id = $request->valuation_method_id;
        $product->photo = $photoPath;

        $product->save();

        Log::info("Product created:", $request->all());

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
