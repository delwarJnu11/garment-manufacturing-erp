<?php

use App\Http\Controllers\Api\vue\AuthController;
use App\Http\Controllers\Api\vue\RolesController;
use Illuminate\Support\Facades\Route;

// ALL AUTH CONTROLLERS START
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('logout', [AuthController::class, 'logout']);
// ALL AUTH CONTROLLERS END


Route::apiResource('/roles', RolesController::class);
// Route::apiResource('/roles', RolesController::class)->middleware('auth:api');
