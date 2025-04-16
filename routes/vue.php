<?php

use App\Http\Controllers\Api\Vue\AuthController;
use App\Http\Controllers\Api\Vue\CategoryController;
use App\Http\Controllers\Api\vue\ProductController;
use App\Http\Controllers\Api\Vue\BuyerController;
use App\Http\Controllers\Api\Vue\RolesController;
use App\Http\Controllers\Api\vue\SupplierController;
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

Route::apiResource('categories', CategoryController::class);
Route::get('/all-categories', [CategoryController::class, 'all']);
Route::get('/sizes', [CategoryController::class, 'size']);
Route::get('/uoms', [CategoryController::class, 'uom']);
Route::apiResource('products', ProductController::class);
Route::get('productTypes', [ProductController::class, 'ProductType']);
Route::get('warehouses', [ProductController::class, 'warehouse']);
Route::apiResource('/suppliers', SupplierController::class);
// Route::apiResource('/roles', RolesController::class)->middleware('auth:api');

// Buyers
Route::apiResource('/buyers', BuyerController::class);
