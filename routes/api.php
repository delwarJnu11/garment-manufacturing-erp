<?php

use App\Http\Controllers\Api\BomDetailsController;
use App\Http\Controllers\Api\CuttingController;
use App\Http\Controllers\Api\OrderDetailsController;


use App\Http\Controllers\Api\PurchaseInvoiceController;
use App\Http\Controllers\Api\RawMaterialController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\SalesInvoiceController;


use App\Http\Controllers\API\PayslipController;
use App\Http\Controllers\Api\ProductController;

use App\Http\Controllers\HrmPayslipsController;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Vue\RoleController;
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



// FarzDev branch React Api
Route::get('suppliers', [PurchaseInvoiceController::class, 'supplier']);
Route::get('warehouses', [PurchaseInvoiceController::class, 'warehouse']);
Route::get('products', [PurchaseInvoiceController::class, 'product']);
Route::post('saveReactpurchase', [PurchaseInvoiceController::class, 'saveReactpurchase']);
Route::get('purchaseOrder/{id}', [PurchaseInvoiceController::class, 'show']);
Route::get('purchase_orders', [PurchaseInvoiceController::class, 'purchase_orders']);
// Product Api
Route::get('get-products', [ProductController::class, 'index']);
Route::post('create-product', [ProductController::class, 'create']);
Route::post('store-product', [ProductController::class, 'store']);
Route::get('stocks', [ProductController::class, 'stock']);

Route::get('/orders', [OrderDetailsController::class, 'getOrders']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/buyers', [OrderController::class, 'getBuyers']);
Route::get('/supervisors', [OrderController::class, 'getSupervisors']);
Route::get('/order-statuses', [OrderController::class, 'getOrderStatuses']);
Route::get('/fabrics', [OrderController::class, 'getFabricsTypes']);
Route::get('/order-details/data', [OrderDetailsController::class, 'fetchData']);
// purchaseOrder  Api
Route::post('purchase', [PurchaseOrderController::class, 'store']);



// Start Api Route

//  Route::get('payslip', [PayslipController::class,'index']);
Route::post('payslip', [PayslipController::class, 'store']);

// End Api Route
Route::post('purchase', [PurchaseOrderController::class, 'store']);
Route::prefix('production-stages')->group(function () {
    Route::put('cutting/update-status/{id}', [CuttingController::class, 'updateStatus'])->name('cutting.updateStatus');
});
// Route::post('/adjustment', [StockAdjustmentController::class, 'store']);

//Vue api ca;;


Route::prefix('vue')->group(function () {
    Route::apiResource('roles', RoleController::class);
});

