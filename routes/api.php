<?php

use App\Http\Controllers\Api\OrderDetailsController;
use App\Http\Controllers\Api\RawMaterialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// API FOR ORDER DETAILS
Route::get('order_details', [OrderDetailsController::class, 'index']);
Route::post('order_details', [OrderDetailsController::class, 'store']);

//Get Raw Material
Route::get('raw_material/{id}', [RawMaterialController::class, 'show']);
