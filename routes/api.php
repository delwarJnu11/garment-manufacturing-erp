<?php

use App\Http\Controllers\Api\OrderDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// API FOR ORDER DETAILS
// Route::get('order_details', [OrderDetailsController::class, 'index']);
Route::resource('aa', OrderDetailsController::class);
