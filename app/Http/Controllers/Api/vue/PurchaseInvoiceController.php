<?php

namespace App\Http\Controllers\Api\Vue;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

//vue
class PurchaseInvoiceController extends Controller
{
  public function index(Request $request) {}


  public function createInvoice(): JsonResponse
  {
    $lastInvoice = DB::table('sales')->latest('id')->first();
    $lastId = $lastInvoice ? $lastInvoice->id : 0;

    return response()->json([
      'last_id' => $lastId,
      'new_invoice_id' => 'INV-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT),
    ]);
  }



  // public function process(Request $request)
  // {
  //   DB::beginTransaction();
  //   Log::info("Recevie Data", $request->all());
  //   try {


  //     DB::commit();
  //   } catch (\Throwable $th) {
  //     //throw $th;
  //   }
  // }
  public function process(Request $request)
  {
    DB::beginTransaction();
    try {
      Log::info("Received Purchase Invoice Data", $request->all());

      // You can handle storing logic here...

      DB::commit();

      return response()->json([
        'message' => 'Purchase invoice processed successfully!',
        'data' => $request->all() // Optional: return received data for testing
      ]);
    } catch (\Throwable $th) {
      DB::rollBack();
      Log::error("Purchase Invoice Processing Failed", ['error' => $th->getMessage()]);
      return response()->json([
        'message' => 'Failed to process purchase invoice',
        'error' => $th->getMessage()
      ], 500);
    }
  }

  public function show(string $id) {}

  public function update(Request $request) {}
}
