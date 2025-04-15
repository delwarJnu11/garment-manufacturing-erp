<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = transactions::all();
        return view('pages.accounts.transactions.index', compact('transactions'));
    }

    // Show the form for creating a new transaction
    public function create()
    {
        return view('pages.accounts.transactions.create');
    }

    // Store a newly created transaction in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'voucher_ref' => 'required|string|max:200',
            'transaction_date' => 'required|date',
            'account_id' => 'required|integer',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'transaction_against' => 'nullable|integer',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
        ]);

        transactions::create($validatedData);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
    }

    // Display the specified transaction
    public function show($id)
    {
        $transaction = transactions::findOrFail($id);
        return view('pages.accounts.transactions.show', compact('transaction'));
    }

    // Show the form for editing the specified transaction
    public function edit($id)
    {
        $transaction = transactions::findOrFail($id);
        return view('pages.accounts.transactions.edit', compact('transaction'));
    }

    // Update the specified transaction in the database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'voucher_ref' => 'required|string|max:200',
            'transaction_date' => 'required|date',
            'account_id' => 'required|integer',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'transaction_against' => 'nullable|integer',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
        ]);

        $transaction = transactions::findOrFail($id);
        $transaction->update($validatedData);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    // Remove the specified transaction from the database
    public function destroy($id)
    {
        $transaction = transactions::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }

    public function balanceSheet()
{
    // Calculate Assets, Liabilities, and Equity
    $assets = DB::table('transactions')
        ->whereIn('account_id', [1, 2, 3, 5, 6, 7, 8, 9])
        ->selectRaw('SUM(debit) - SUM(credit) as total_assets')
        ->first();

    $liabilities = DB::table('transactions')
        ->whereIn('account_id', [10, 13, 14, 15, 16, 17, 18, 19, 20, 40, 41, 42, 43, 44, 45, 46])
        ->selectRaw('SUM(credit) - SUM(debit) as total_liabilities')
        ->first();

    $equity = DB::table('transactions')
        ->whereIn('account_id', [24, 25])
        ->selectRaw('SUM(debit) - SUM(credit) as total_equity')
        ->first();

    // Return to view
    return view('pages.accounts.reports.balanceSheet', [
        'assets' => $assets->total_assets,
        'liabilities' => $liabilities->total_liabilities,
        'equity' => $equity->total_equity,
    ]);

    echo $assets;
}

}
