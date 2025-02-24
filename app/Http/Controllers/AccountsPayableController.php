<?php

namespace App\Http\Controllers;

use App\Models\AccountsPayable;
use Illuminate\Http\Request;

class AccountsPayableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountsPayable = AccountsPayable::all();
        return view('accounts_payable.index', compact('accountsPayable'));
    }

    public function create()
    {
        return view('accounts_payable.create');
    }

    public function store(Request $request)
    {
        AccountsPayable::create($request->all());
        return redirect()->route('accounts_payable.index');
    }

    public function show($id)
    {
        $account = AccountsPayable::findOrFail($id);
        return view('accounts_payable.show', compact('account'));
    }

    public function edit($id)
    {
        $account = AccountsPayable::findOrFail($id);
        return view('accounts_payable.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $account = AccountsPayable::findOrFail($id);
        $account->update($request->all());
        return redirect()->route('accounts_payable.index');
    }

    public function destroy($id)
    {
        $account = AccountsPayable::findOrFail($id);
        $account->delete();
        return redirect()->route('accounts_payable.index');
    }
}
