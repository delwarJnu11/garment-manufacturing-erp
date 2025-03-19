<?php

use App\Http\Controllers\Api\BomDetailsController;
use App\Http\Controllers\Api\CuttingController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\OrderDetailsController;
use App\Http\Controllers\Api\Payslip_ItemsController;
use App\Http\Controllers\Api\PayslipController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\HrmPayslipsController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\RawMaterialController;
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
Route::post('purchase',[ PurchaseOrderController::class,'store']);



 // Start HRM Api Route

 Route::post('payslip', [PayslipController::class,'store']);


//  Start React Api
 Route::get('payslip', [PayslipController::class,'store']);
//  Route::get('payslip', [PayslipController::class, 'getPayslips']);
 Route::get('payslipindex', [PayslipController::class,'index']);
 Route::get('employeeapi', [EmployeeController::class,'index']);
 Route::get('payslip_itemsapi', [Payslip_ItemsController::class,'index']);
 Route::get('employeeapi', [EmployeeController::class,'index']);
 Route::get('departments', [DepartmentController::class, 'index']);
 Route::get('designations', [DesignationController::class, 'index']);
//  End React Api

 // End HRM Api Route


 
Route::post('purchase', [PurchaseOrderController::class, 'store']);
Route::prefix('production-stages')->group(function () {
    Route::put('cutting/update-status/{id}', [CuttingController::class, 'updateStatus'])->name('cutting.updateStatus');
});
// Route::post('/adjustment', [StockAdjustmentController::class, 'store']);
