<?php

use App\Http\Controllers\Api\vue\AuthController;
use App\Http\Controllers\Api\Vue\CategoryController;
use App\Http\Controllers\Api\Vue\RoleController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Vue\UserController;

// ALL AUTH CONTROLLERS START
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('logout', [AuthController::class, 'logout']);
// ALL AUTH CONTROLLERS END


Route::apiResource('/roles', RoleController::class);
// Route::apiResource('/roles', RolesController::class)->middleware('auth:api');

// Farzana 
Route::apiResource('users', UserController::class);

Route::apiResource('categories', CategoryController::class);
