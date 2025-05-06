<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountGroupsController;
use App\Http\Controllers\Api\Vue\AuthController;
use App\Http\Controllers\Api\Vue\CategoryController;
use App\Http\Controllers\Api\Vue\ProductController;
use App\Http\Controllers\Api\Vue\BuyerController;
use App\Http\Controllers\Api\Vue\PurchaseInvoiceController;
use App\Http\Controllers\Api\Vue\FabricsTypeController;
use App\Http\Controllers\Api\Vue\OrderStatusController;
use App\Http\Controllers\Api\Vue\RolesController;
use App\Http\Controllers\Api\Vue\SupplierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Vue\UserController;
use App\Models\ProductType;

// ALL AUTH CONTROLLERS START
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('logout', [AuthController::class, 'logout']);
// ALL AUTH CONTROLLERS END


Route::apiResource('/roles', RolesController::class);


// Farzana 
Route::apiResource('users', UserController::class);
Route::get('/supervisors', [UserController::class, 'getSupervisors']);

Route::apiResource('categories', CategoryController::class);
Route::get('/all-categories', [CategoryController::class, 'all']);
Route::get('/sizes', [CategoryController::class, 'size']);
Route::get('/uoms', [CategoryController::class, 'uom']);
Route::apiResource('products', ProductController::class);
Route::get('allProducts', [ProductController::class, 'allProducts']);
Route::get('productTypes', [ProductController::class, 'ProductType']);
Route::get('warehouses', [ProductController::class, 'warehouse']);
Route::apiResource('/suppliers', SupplierController::class);
Route::get('/allSuppliers', [SupplierController::class, 'allSuppliers']);
// Route::apiResource('/roles', RolesController::class)->middleware('auth:api');

// Buyers
Route::apiResource('/buyers', BuyerController::class);


// purchaseOrder invoice 
Route::get('/showInvoice', [PurchaseInvoiceController::class, 'index']);
Route::get('/invoice-id', [PurchaseInvoiceController::class, 'createInvoice']);
Route::post('/purchaseInvoice', [PurchaseInvoiceController::class, 'process']);
Route::get('/purchaseInvoice/{id}', [PurchaseInvoiceController::class, 'show'])->name('invoice');

// Orders
Route::prefix('orders')->group(function () {
    Route::apiResource('/status', OrderStatusController::class);
});

// Fabrics Type Route
Route::apiResource('/fabrics/types', FabricsTypeController::class);


// Accounts Module
Route::apiResource('accounts', AccountController::class);
Route::apiResource('accountGroups', AccountGroupsController::class);
Route::apiResource('transactions', TransactionController::class);
