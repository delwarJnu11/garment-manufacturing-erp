<?php

namespace App\Http\Controllers;

use App\Models\accountGroups;
use App\Models\accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        $accounts = accounts::all();
        return view('pages.accounts.accounts.index', compact('accounts'));
    }

    public function create()
    {
        $accountGroups = accountGroups::all(); // Fetch all account groups for the select dropdown
        return view('pages.accounts.accounts.create', compact('accountGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
            'name' => 'required|string|max:50',
            'account_group_id' => 'required|exists:account_groups,id',
            'is_payment_method' => 'nullable|integer',
            'is_trx_no_required' => 'nullable|integer',
            'description' => 'nullable|string',
            'is_active' => 'required|integer',
        ]);

        accounts::create($request->all());
        return redirect()->route('pages.accounts.accounts.index')->with('success', 'Account created successfully!');
    }

    public function edit(Account $account)
    {
        $accountGroups = accountGroups::all();
        return view('pages.accounts.accounts.edit', compact('account', 'accountGroups'));
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'code' => 'required|integer',
            'name' => 'required|string|max:50',
            'account_group_id' => 'required|exists:account_groups,id',
            'is_payment_method' => 'nullable|integer',
            'is_trx_no_required' => 'nullable|integer',
            'description' => 'nullable|string',
            'is_active' => 'required|integer',
        ]);

        $account->update($request->all());
        return redirect()->route('pages.accounts.accounts.index')->with('success', 'Account updated successfully!');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('pages.accounts.accounts.index')->with('success', 'Account deleted successfully!');
    }

}
