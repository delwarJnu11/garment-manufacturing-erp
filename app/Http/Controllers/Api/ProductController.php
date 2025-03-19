<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('product_type', 'category_type', 'size', 'uom')->paginate(10);
        return  response()->json(["products" => $products]);
    }
}
