<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = PurchaseOrder::with('inv_supplier')->paginate(5);
        return view('pages.purchase_&_supliers.purchasePayment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(PurchaseOrder $purchaseOrder)
    // {
    //     return view('pages.purchase_&_supliers.purchasePayment.edit', [
    //         'purchaseOrder' => $purchaseOrder,
    //         'btnText' => 'Update Payment'
    //     ]);
    // }
    public function edit(PurchaseOrder $purchaseOrder, $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id); // Ensures it exists

        return view('pages.purchase_&_supliers.purchasePayment.edit', ['btnText' => 'Update Payment'], compact('purchaseOrder'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id); // Ensure the record exists

        $request->validate([
            'paid_amount' => 'required|numeric|min:0|max:' . $purchaseOrder->total_amount,
            'payment_method' => 'nullable|string',
        ]);

        $purchaseOrder->update([
            'paid_amount' => $request->paid_amount,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
