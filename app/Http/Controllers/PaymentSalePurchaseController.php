<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\SalesInvoiceDetail;
use Illuminate\Console\View\Components\Component;
use Illuminate\Http\Request;

class PaymentSalePurchaseController extends Controller
{
    /**
     * Display a listing For Purchase
     */
    public function index()
    {
        $payments = PurchaseOrder::with('inv_supplier')->paginate(5);
        return view('pages.purchase_&_supliers.purchasePayment.index', compact('payments'));
    }
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
    public function salesPayment()
    {
        $salesPayments = SalesInvoiceDetail::with('order.buyer', 'salesInvoice.invoice_status')->get();
        // print_r($salesPayments->toArray());
        return view('pages.orders_&_Buyers.sales_payment.sales_payment', compact('salesPayments'));
    }
}
