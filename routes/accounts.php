<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountGroupsController;
use App\Http\Controllers\ChartOfAccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TrialBalanceController;
use Illuminate\Support\Facades\Route;

Route::prefix('accounts')->name('accounts.')->group(function () {
    Route::resource('accounts', AccountController::class);
    Route::resource('accountGroups', AccountGroupsController::class);
    Route::resource('transactions', TransactionController::class);

    Route::get('ledgers', [AccountController::class, 'ledger_report'])->name('ledgers');
    Route::get('balanceSheet', [TransactionController::class, 'balanceSheet'])->name('balanceSheet');

    Route::get('trialbalance', [TrialBalanceController::class, 'index'])->name('trialbalance');
    Route::get('trialbalance/pdf', [TrialBalanceController::class, 'printPdf'])->name('trial.balance.pdf');

    Route::prefix('reports')->group(function () {
        Route::get('finance', function () {
            return view('pages.accounts.reports.finance');
        });
        Route::get('receivable-payable', function () {
            return view('pages.accounts.reports.repa');
        });
        Route::get('GeneralLedgerReports', function () {
            return view('pages.accounts.reports.ledger');
        });
        Route::get('chartOfAccounts', [ChartOfAccountController::class, 'index'])->name('chartOfAccounts');
        Route::get('/chartOfAccounts/pdf', [ChartOfAccountController::class, 'printPdf'])->name('chart.of.accounts.pdf');
    });
});
