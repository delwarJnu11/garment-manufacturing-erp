<?php

use App\Http\Controllers\Api\Vue\AuthController;
use App\Http\Controllers\Api\Vue\CategoryController;
use App\Http\Controllers\Api\vue\ProductController;
use App\Http\Controllers\Api\Vue\BuyerController;
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

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
// Route::apiResource('/roles', RolesController::class)->middleware('auth:api');

// Buyers
Route::apiResource('/buyers', BuyerController::class);

use App\Http\Controllers\Api\Vue\AccountController;
use App\Http\Controllers\Api\Vue\AccountGroupController;
use App\Http\Controllers\Api\Vue\RoleController;
use App\Http\Controllers\Api\Vue\TransactionController;
use App\Http\Controllers\Api\Vue\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('roles', RoleController::class);
Route::apiResource('users', UserController::class);

Route::apiResource('accounts', AccountController::class);
Route::apiResource('accountGroups', AccountGroupController::class);
Route::apiResource('transactions', TransactionController::class);

Route::get('test', function(){
    return print_r('Test');
});

// Route::get('roles', [RoleController::class, 'index']);
// Route::get('roles/', [RoleController::class, 'index']);
