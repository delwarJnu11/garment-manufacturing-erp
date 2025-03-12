<?php

use App\Http\Controllers\Api\OrderDetailsController;
use App\Http\Controllers\API\PayslipController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\HrmPayslipsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



// API FOR ORDER DETAILS
// Route::get('order_details', [OrderDetailsController::class, 'index']);
Route::get('order', [OrderDetailsController::class, 'index']);
// purchaseOrder  Api
Route::post('purchase',[ PurchaseOrderController::class,'store']);



 // Start Api Route

//  Route::get('payslip', [PayslipController::class,'index']);
 Route::post('payslip', [PayslipController::class,'store']);

 // End Api Route
