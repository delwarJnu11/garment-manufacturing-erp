<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use Illuminate\Http\Request;

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
}
