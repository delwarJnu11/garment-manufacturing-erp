<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\Order;
use App\Models\Raw_material;
use App\Models\Size;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::all();
        $boms = BOM::with(['order.buyer', 'orderDetails', 'bomDetails'])
            ->get()
            ->map(function ($bom) {
                $sizes = $bom->bomDetails->groupBy('size_id');

                // Dynamically generate size-based costs
                $sizeCosts = [];
                foreach ($sizes as $sizeId => $details) {
                    $sizeCosts["size_{$sizeId}"] = $details->sum(fn($detail) => ($detail->quantity_used + (($detail->wastage * $detail->quantity_used) / 100)) * $detail->unit_price) ?? 0;
                }

                return array_merge([
                    'bom_id' => $bom->id,
                    'order_id' => $bom->order->order_number,
                    'buyer_name' => $bom->order->buyer->first_name . " " . $bom->order->buyer->last_name,
                    'product_name' => optional($bom->orderDetails->first())->product->name,
                    'labour_cost' => $bom->labour_cost,
                    'overhead_cost' => $bom->overhead_cost,
                    'utility_cost' => $bom->utility_cost,
                    'total_cost' => $bom->total_cost,
                    'delivery_date' => optional($bom->order->delivery_date)->format('d M Y'),
                    'status' => $bom->order->status,
                ], $sizeCosts);
            });

        return view('pages.production.bom.index', compact('boms', 'sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $orders = Order::with([
        //     'buyer',
        //     'status',
        //     'orderDetails.product',
        //     'orderDetails.size',
        //     'orderDetails.color',
        //     'orderDetails.uom'
        // ])->groupBy('order_number')->get();
        $orders = Order::selectRaw('MIN(id) as id, order_number')
            ->with([
                'buyer',
                'status',
                'orderDetails.product',
                'orderDetails.size',
                'orderDetails.color',
                'orderDetails.uom'
            ])
            ->groupBy('order_number')
            ->get();


        // Extract product names and IDs and ensure uniqueness
        $products = $orders->flatMap(function ($order) {
            return $order->orderDetails->map(function ($detail) use ($order) {
                return [
                    'order_id' => $order->id,
                    'name' => $detail->product->name,
                ];
            });
        })->unique('name')->values();

        return view('pages.production.bom.create', compact('orders', 'products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'order_id' => 'required|integer',
            'material_cost' => 'nullable|numeric',
            'labour_cost' => 'required|numeric',
            'overhead_cost' => 'required|numeric',
            'utility_cost' => 'required|numeric',
            'total_cost' => 'nullable|numeric',
        ]);

        Bom::create([
            'order_id' => $request->order_id,
            'material_cost' => 0,
            'labour_cost' => $request->labour_cost,
            'overhead_cost' => $request->overhead_cost,
            'utility_cost' => $request->utility_cost,
            'total_cost' => 0,
        ]);
        return redirect()->route('bom_details.create');
    }

    /**
     * Display the specified resource.
     */

    public function show(Bom $bom, Request $request)
    {
        $bomDetails = $bom->bomDetails()
            ->with('product', 'size', 'bom.order', 'bom.order.buyer')
            ->get()
            ->groupBy('size_id');

        $data = [];
        foreach ($bomDetails as $size_id => $details) {
            $totalPrice = 0;
            $materials = [];

            foreach ($details as $detail) {
                $productName = $detail->product ? $detail->product->name : 'Unknown Product';
                $wastage = $detail->quantity_used * ($detail->wastage / 100);
                $materialTotal = ($detail->quantity_used + $wastage) * $detail->unit_price;
                $totalPrice += $materialTotal;
                $order = $detail->bom->order;
                $buyer = $detail->bom->order->buyer;

                $materials[] = [
                    'material_name' => $productName,
                    'quantity_used' => $detail->quantity_used,
                    'unit_price' => $detail->unit_price,
                    'wastage' => number_format($wastage, 4),
                    'total_price' => number_format($materialTotal, 2),
                ];
            }

            $data[] = [
                'size' => Size::find($size_id)->name ?? 'Unknown Size',
                'materials' => $materials,
                'total_cost' => number_format($totalPrice, 2),
            ];
        }

        // **Check if PDF download is requested**
        if ($request->has('download')) {
            $pdf = Pdf::loadView('pages.production.bom.pdf', compact('bom', 'data', 'order', 'buyer'))
                ->setPaper('a4', 'portrait');

            return $pdf->download('BOM_Details.pdf');
        }

        return view('pages.production.bom.show', compact('bom', 'data', 'order', 'buyer'));
    }


    /**
     * 
     * Download BOM As PDF
     */

    // public function downloadBOM(Bom $bom)
    // {
    //     $bomDetails = $bom->bomDetails()
    //         ->with('product', 'size', 'bom.order', 'bom.order.buyer',)
    //         ->get()
    //         ->groupBy('size_id');

    //     $data = [];
    //     foreach ($bomDetails as $size_id => $details) {
    //         $totalPrice = 0;
    //         $materials = [];

    //         foreach ($details as $detail) {
    //             // Ensure product exists before accessing its properties
    //             $productName = $detail->product ? $detail->product->name : 'Unknown Product';

    //             // Calculate wastage (0.2% of quantity used)
    //             $wastage = $detail->quantity_used * ($detail->wastage / 100);

    //             // Total price calculation
    //             $materialTotal = ($detail->quantity_used + $wastage) * $detail->unit_price;
    //             $totalPrice += $materialTotal;
    //             $order = $detail->bom->order;
    //             $buyer = $detail->bom->order->buyer;

    //             $materials[] = [
    //                 'material_name' => $productName,
    //                 'quantity_used' => $detail->quantity_used,
    //                 'unit_price' => $detail->unit_price,
    //                 'wastage' => number_format($wastage, 4),
    //                 'total_price' => number_format($materialTotal, 2),
    //             ];
    //         }

    //         // Store data for the size
    //         $data[] = [
    //             'size' => Size::find($size_id)->name ?? 'Unknown Size',
    //             'materials' => $materials,
    //             'total_cost' => number_format($totalPrice, 2),
    //         ];
    //     }

    //     // Load Blade view into PDF
    //     $pdf = Pdf::loadView('pages.production.bom.show', compact('bom', 'data', 'order', 'buyer'));

    //     return $pdf->download("BOM_Order_{$order->order_number}.pdf");
    // }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bom $bom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bom $bom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bom $bom)
    {
        //
    }
}
