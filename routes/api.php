<?php

use App\Http\Controllers\Api\OrderDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('test', function () {
    return response()->json(['message' => 'hello']);
});

Route::get('order', [OrderDetailsController::class, 'index']);
