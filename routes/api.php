<?php

use App\Http\Controllers\Api\BomDetailsController;
use App\Http\Controllers\Api\OrderDetailsController;
use App\Http\Controllers\api\PurchaseInvoiceController;
use App\Http\Controllers\Api\RawMaterialController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\SalesInvoiceController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



// API FOR ORDER DETAILS
Route::get('order_details', [OrderDetailsController::class, 'index']);
Route::post('order_details', [OrderDetailsController::class, 'store']);

// Create Bom Details
Route::post('bom_details', [BomDetailsController::class, 'store']);

//Get Raw Material
Route::get('raw_material/{id}', [RawMaterialController::class, 'show']);
// Route::get('order_details', [OrderDetailsController::class, 'index']);
Route::get('order', [OrderDetailsController::class, 'index']);
// purchaseOrder  Api
Route::post('purchase', [PurchaseOrderController::class, 'store']);

Route::post('salesinvoice', [SalesInvoiceController::class, 'store']);
Route::get('suppliers', [PurchaseInvoiceController::class, 'supplier']);
Route::get('warehouses', [PurchaseInvoiceController::class, 'warehouse']);
Route::get('products', [PurchaseInvoiceController::class, 'product']);

