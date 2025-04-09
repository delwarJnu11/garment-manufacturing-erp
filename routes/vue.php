<?php

use App\Http\Controllers\Api\Vue\AuthController;
use App\Http\Controllers\Api\Vue\CategoryController;
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
