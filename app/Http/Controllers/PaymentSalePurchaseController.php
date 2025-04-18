<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
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
    // public function salesPayment()
    // {
    //     $salesPayments = SalesInvoiceDetail::with('order.buyer', 'order', 'salesInvoice.invoice_status')->get();
    //     // print_r($salesPayments->toArray());
    //     return view('pages.orders_&_Buyers.sales_payment.sales_payment', compact('salesPayments'));
    // }


    public function salesPayment()
    {
        $salesPayments = SalesInvoiceDetail::with('order.buyer', 'order', 'salesInvoice.invoice_status')
            ->get()
            ->unique(function ($payment) {
                return $payment->sales_invoice_id . '-' . $payment->order_id;
            });

        return view('pages.orders_&_buyers.sales_payment.sales_payment', compact('salesPayments'));
    }

    public function editSalesPayment($id)
    {
        $salesInvoice = SalesInvoice::with('payment_method')->findOrFail($id);

        $salesPayments = PaymentMethod::all(); // Get all available payment methods

        return view('pages.orders_&_Buyers.sales_payment.edit', [
            'btnText' => 'Update Payment',
            'salesInvoice' => $salesInvoice,
            'salesPayments' => $salesPayments
        ]);
    }


    public function updateSalesPayment(Request $request, $id)
    {
        $salesInvoice = SalesInvoice::findOrFail($id);

        $request->validate([
            'paid_amount' => 'required|numeric|min:0|max:' . $salesInvoice->total_amount,
            'payment_method_id' => 'nullable|exists:payment_methods,id',
        ]);

        $newPaidAmount = $salesInvoice->paid_amount + $request->paid_amount; // Add old + new

        if ($newPaidAmount > $salesInvoice->total_amount) {
            return redirect()->route('salesPayments')->withErrors(['paid_amount' => 'Total paid amount cannot exceed the total invoice amount.']);
        }

        // Determine payment status
        if ($newPaidAmount == $salesInvoice->total_amount) {
            $paymentStatus = 1; // Paid
        } elseif ($newPaidAmount > 0) {
            $paymentStatus = 2; // Partially Paid
        } else {
            $paymentStatus = 3; // Due
        }

        $salesInvoice->update([
            'paid_amount' => $newPaidAmount,
            'payment_method_id' => $request->payment_method_id,
            'payment_status_id' => $paymentStatus, // Update the status
        ]);

        return redirect()->route('sales-invoice.index')->with('success', 'Payment updated successfully.');
    }
}
