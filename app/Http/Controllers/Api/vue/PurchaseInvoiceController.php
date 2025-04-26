<?php

namespace App\Http\Controllers\Api\Vue;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\ProductLot;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

//vue
class PurchaseInvoiceController extends Controller
{
  public function index(Request $request)
  {
    try {
      $invoiceQuery = PurchaseOrder::with('inv_supplier');
      if ($request->search) {
        $invoiceQuery->where(function ($query) use ($request) {
          $query->where('id', 'like', '%' . $request->search . '%');
          $query->orWhereHas('inv_supplier', function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->search . '%');
          });
        });
      }
      $invoice = $invoiceQuery->paginate(10);
      return response()->json(['purchaseOrders' => $invoice], 200);
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      return response()->json(['Error fetch ' => $th->getMessage()], 500);
    }
  }

  public function createInvoice(): JsonResponse
  {
    $lastInvoice = DB::table('sales')->latest('id')->first();
    $lastId = $lastInvoice ? $lastInvoice->id : 0;

    return response()->json([
      'last_id' => $lastId,
      'new_invoice_id' => 'INV-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT),
    ]);
  }
  public function process(Request $request)
  {
    DB::beginTransaction();
    try {
      // Log::info("Received Purchase Invoice Data", $request->all());
      $products = is_string($request->products) ? json_decode($request->products, true) : $request->products;
      $purchaseDate = now();
      $pendingAmount = $request->subtotal - $request->paid_amount;

      $purchase = PurchaseOrder::create([
        'supplier_id' => $request->supplier_id,
        'purchase_date' => $purchaseDate,
        'warehouse_id' => $request->warehouse_id,
        'delivery_date' => now()->addDays(7),
        'shipping_address' => "123 Factory Road City, Country",
        'total_amount' => $request->grandTotal,
        'paid_amount' => $request->paid_amount,
        'status_id' => 1,
        'discount' => $request->totalDiscount,
        'vat' => $request->totalVat,

      ]);
      $details = [];
      // Log::info("Received Purchase Invoice Data", $purchase->toArray());
      foreach ($products as $product) {
        $detail = PurchaseOrderDetail::create([
          'purchase_id' => $purchase->id,
          'product_id' => $product['item_id'],
          'quantity' => $product['qty'],
          'lot_id' => null,
          'price' => $product['price'],
          'percent_of_discount' => $product['discount'],
          'discount' => $product['discountAmount'],
          'percent_of_vat' => $product['vat'],
          'vat' => $product['vatAmount']
        ]);
        $details[] = $detail->toArray(); // collect for log
        $lot = ProductLot::create([
          'product_id' => $product['item_id'],
          'qty' => $product['qty'],
          'cost_price' => $product['price'],
          'sales_price' => 0.0,
          'warehouse_id' => $request->warehouse_id,
          'transaction_type_id' => 3,
          'description' => 'Purchase Item',
          'created_at' => now(),

        ]);
        if (!$lot) {
          throw new \Exception('Failed to create Lot ');
        }
        $stock = Stock::create([
          'product_id' => $product['item_id'],
          'qty' => $product['qty'],
          'transaction_type_id' => 3,
          'warehouse_id' => $request->warehouse_id,
          'lot_id' => $lot->id,
          'created_at' => now(),
        ]);
      }

      // Log::info("PurchaseOrder saved", $purchase->toArray());
      // Log::info("PurchaseOrderDetails saved", $details);
      // Log::info("Lot saved",  $lot->toArray());
      // Log::info("stock", $stock->toArray());
      DB::commit();
      return response()->json([
        'message' => 'Purchase invoice processed successfully!',
        'purchase' => $purchase,
        'details' => $details
      ], 200);
    } catch (\Throwable $th) {
      DB::rollBack();
      Log::error("Purchase Invoice Processing Failed", [
        'error' => $th->getMessage(),
        'file' => $th->getFile()
      ]);
      return response()->json([
        'message' => 'Failed to process purchase invoice',
        'error' => $th->getMessage()
      ], 500);
    }
  }

  public function show(string $id) {}

  public function update(Request $request) {}
}
