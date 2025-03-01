<?php

namespace App\Http\Controllers;

use App\Mail\productMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCatelogue;
use App\Models\Uom;
use App\Models\Valuation_methods;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\File;

class ProductCatelogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCatelogues = ProductCatelogue::with('category', 'uom')->paginate(5);
    
        return view('pages.purchase_&_supliers.productCatelogues.product', compact('productCatelogues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $uoms = Uom::all();
        $valuation_methods = Valuation_methods::all();

        return view('pages.purchase_&_supliers.productCatelogues.create', compact('categories', 'uoms', 'valuation_methods'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'sku' => 'required|string|max:100|unique:products,sku',
                'description' => 'nullable|string',
                'barcode' => 'nullable|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'uom_id' => 'nullable|exists:uoms,id',
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
            $product = new ProductCatelogue();
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->barcode = $request->barcode;
            $product->category_id = $request->category_id;
            $product->uom_id = $request->uom_id;
            $product->photo = $photoPath;
            $product->save();

            return redirect()->route('products.index')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $product = ProductCatelogue::findOrFail($id);
        return view('pages.purchase_&_supliers.productCatelogues.show', compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = ProductCatelogue::findOrFail($id);
        $categories = Category::all();
        $uoms = Uom::all();
        $valuation_methods = Valuation_methods::all();

        return view('pages.purchase_&_supliers.productCatelogues.edit', compact('product', 'categories', 'uoms', 'valuation_methods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = ProductCatelogue::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $id,
            'description' => 'nullable|string',
            'barcode' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'uom_id' => 'nullable|exists:uoms,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            // Delete old image if it exists
            if ($product->photo && File::exists(public_path($product->photo))) {
                File::delete(public_path($product->photo));
            }

            // Store the new image
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $fileName);
            $product->photo = 'uploads/products/' . $fileName;
        }

        // Update product details
        $product->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'description' => $request->description,
            'barcode' => $request->barcode,
            'category_id' => $request->category_id,
            'uom_id' => $request->uom_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = ProductCatelogue::findOrFail($id);

        // Delete image if exists
        if ($product->photo && File::exists(public_path($product->photo))) {
            File::delete(public_path($product->photo));
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
