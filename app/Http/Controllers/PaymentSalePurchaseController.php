<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceDetail;
// use Illuminate\Console\View\Components\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    // sales payment
    public function salesPayment()
    {
        $salesPayments = SalesInvoiceDetail::with('order.buyer', 'salesInvoice.invoice_status')->get();
        // print_r($salesPayments->toArray());
        return view('pages.orders_&_Buyers.sales_payment.sales_payment', compact('salesPayments'));
    }


    public function editSalesPayment(SalesInvoice $salesInvoice, $id)
    {
        $salesInvoice = SalesInvoice::findOrFail($id); // Ensure it exists
        $salesPayments = SalesInvoiceDetail::where('sales_invoice_id', $id)
            ->with('salesInvoice.payment_method')
            ->get();

        return view('pages.orders_&_Buyers.sales_payment.edit', [
            'btnText' => 'Update Payment',
            'salesInvoice' => $salesInvoice,
            'salesPayments' => $salesPayments
        ]);
    }

    // public function updateSalesPayment(Request $request, $id)
    // {
    //     // $salesInvoice = SalesInvoice::findOrFail($id); // Ensure the record exists

    //     // $request->validate([
    //     //     'paid_amount' => 'required|numeric|min:0|max:' . $salesInvoice->total_amount,
    //     //     'payment_method_id' => 'nullable|exists:payment_methods,id',
    //     // ]);

    //     // // Add new paid amount to existing paid amount
    //     // $newPaidAmount = $salesInvoice->paid_amount + $request->paid_amount;

    //     // // Ensure total paid amount does not exceed total amount
    //     // if ($newPaidAmount > $salesInvoice->total_amount) {
    //     //     return redirect()->back()->with('error', 'Paid amount exceeds total amount.');
    //     // }

    //     // // Update sales invoice with new paid amount and payment method
    //     // $salesInvoice->update([
    //     //     'paid_amount' => $newPaidAmount,
    //     //     'payment_method_id' => $request->payment_method_id,
    //     // ]);

    //     // return redirect()->route('salesPayments')->with('success', 'Payment updated successfully.');
    //     dd($request->all());
    // }

    public function updateSalesPayment(Request $request, $id)
    {
        \Log::info('Payment Update Request:', $request->all());
    
        $salesInvoice = SalesInvoice::findOrFail($id);
    
        $request->validate([
            'paid_amount' => 'required|numeric|min:0|max:' . $salesInvoice->total_amount,
            'payment_method_id' => 'required|exists:payment_methods,id', // Ensure ID is valid
        ]);
    
        $salesInvoice->update([
            'paid_amount' => $request->paid_amount,
            'payment_method_id' => $request->payment_method_id, // Correctly updates ID
        ]);
    
        return redirect()->route('salesPayments')->with('success', 'Payment updated successfully.');
    }
    

}
