<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return response()->json([
            "status" => 200,
            "message" => "product get successfully",
            "data" => $products,
        ]);
    }
}
