<?php
use App\Http\Controllers\AccountGroupsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AccountTypesController;
use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\AssetTypesController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;


Route::resource('assetRegister', AssetStatusController::class);
Route::resource('assetTypes', AssetTypesController::class);
Route::resource('accountTypes', AccountTypesController::class);
Route::resource('accounts', AccountsController::class);
Route::resource('accountGroups', AccountGroupsController::class);
Route::resource('transactions', TransactionsController::class);
Route::prefix('reports')->group(function(){
    Route::get('finance', function(){ return view('pages.accounts.reports.finance'); });
    Route::get('receivable-payable', function(){ return view('pages.accounts.reports.repa'); });
    Route::get('GeneralLedgerReports', function(){ return view('pages.accounts.reports.ledger'); });
});
