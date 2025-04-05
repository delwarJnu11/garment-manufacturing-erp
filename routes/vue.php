<?php

use App\Http\Controllers\Api\Vue\RoleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('roles', RoleController::class);
Route::get('test', function(){
    return print_r('Test');
});

// Route::get('roles', [RoleController::class, 'index']);
// Route::get('roles/', [RoleController::class, 'index']);
