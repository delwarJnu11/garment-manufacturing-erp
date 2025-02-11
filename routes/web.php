<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard-home');
});

Route::get('warehouse',function(){
    return view('backend.Inventory.warehouse.warehouse');
});
