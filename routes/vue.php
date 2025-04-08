<?php

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
