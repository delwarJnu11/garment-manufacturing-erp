<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountGroupsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AccountTypesController;
use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\AssetTypesController;
use App\Http\Controllers\ChartOfAccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TrialBalanceController;
use Illuminate\Support\Facades\Route;


Route::resource('assetRegister', AssetStatusController::class);
Route::resource('assetTypes', AssetTypesController::class);
Route::resource('accountTypes', AccountTypesController::class);
Route::resource('accounts', AccountsController::class);
Route::resource('accountGroups', AccountGroupsController::class);
Route::resource('transactions', TransactionController::class);
Route::get('ledgers',[AccountsController::class, 'ledger_report']);
Route::get('accounts/balanceSheet',[TransactionController::class, 'balanceSheet']);

Route::get('trialbalance', [TrialBalanceController::class, 'index'])->name('trial.balance.index');
Route::get('/trialbalance/pdf', [TrialBalanceController::class, 'printPdf'])->name('trial.balance.pdf');

Route::prefix('reports')->group(function(){
    Route::get('finance', function(){ return view('pages.accounts.reports.finance'); });
    Route::get('receivable-payable', function(){ return view('pages.accounts.reports.repa'); });
    Route::get('GeneralLedgerReports', function(){ return view('pages.accounts.reports.ledger'); });
    Route::get('chartofaccount', [ChartOfAccountController::class, 'index']);
    Route::get('/chartofaccount/pdf', [ChartOfAccountController::class, 'printPdf'])->name('chart.of.accounts.pdf');
});
