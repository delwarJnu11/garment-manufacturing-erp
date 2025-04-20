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
    public function index(Request $request)
    {
       
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
      Log::info("Recevie Data", $request->all());
      try {
        

        DB::commit();
      } catch (\Throwable $th) {
        //throw $th;
      }
    }

    public function show(string $id)
    {
        
    }

    public function update(Request $request)
    {
       
    }

  
}
