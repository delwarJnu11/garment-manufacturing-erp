<?php

use App\Http\Controllers\Api\Vue\AuthController;
use App\Http\Controllers\Api\Vue\CategoryController;
use App\Http\Controllers\Api\Vue\ProductController;
use App\Http\Controllers\Api\Vue\BuyerController;
use App\Http\Controllers\Api\Vue\FabricsTypeController;
use App\Http\Controllers\Api\Vue\OrderStatusController;
use App\Http\Controllers\Api\Vue\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Vue\UserController;

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
Route::apiResource('products', ProductController::class);
// Route::apiResource('/roles', RolesController::class)->middleware('auth:api');

// Buyers
Route::apiResource('/buyers', BuyerController::class);

// Orders
Route::prefix('orders')->group(function () {
    Route::apiResource('/status', OrderStatusController::class);
});

// Fabrics Type Route
Route::apiResource('/fabrics/types', FabricsTypeController::class);
