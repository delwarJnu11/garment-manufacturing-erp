<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivable;
use Illuminate\Http\Request;

class AccountsReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountsReceivable = AccountsReceivable::all();
        return view('accounts_receivable.index', compact('accountsReceivable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts_receivable.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        AccountsReceivable::create($request->all());
        return redirect()->route('accounts_receivable.index');
    }

    public function show($id)
    {
        $account = AccountsReceivable::findOrFail($id);
        return view('accounts_receivable.show', compact('account'));
    }

    public function edit($id)
    {
        $account = AccountsReceivable::findOrFail($id);
        return view('accounts_receivable.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $account = AccountsReceivable::findOrFail($id);
        $account->update($request->all());
        return redirect()->route('accounts_receivable.index');
    }

    public function destroy($id)
    {
        $account = AccountsReceivable::findOrFail($id);
        $account->delete();
        return redirect()->route('accounts_receivable.index');
    }
}
