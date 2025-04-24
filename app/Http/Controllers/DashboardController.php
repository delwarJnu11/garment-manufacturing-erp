<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\InvSupplier;
use App\Models\Order;
use App\Models\ProductCatelogue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuyers = Buyer::count();
        $totalorders = Order::count();
        $suppliers = InvSupplier::paginate(3);
        $productCatalogs = ProductCatelogue::paginate(3);
        return view('pages.dashboard-home', compact('totalBuyers', 'totalorders', 'suppliers', 'productCatalogs'));
    }
}
