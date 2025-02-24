<?php

namespace App\Http\Controllers;

use App\Models\accountGroups;
use Illuminate\Http\Request;

class AccountGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/AccountGroupsController.php
    public function index()
    {
        $accountGroups = accountGroups::all();
        return view('pages.accounts.accountGroups.index', compact('accountGroups'));
    }

    public function create()
    {
        return view('pages.accounts.accountGroups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
            'is_active' => 'required|integer',
        ]);

        accountGroups::create($request->all());
        return redirect('accountGroups')->with('success', 'Account Group created successfully!');
    }

    public function edit(accountGroups $accountGroup)
    {
        return view('pages.accounts.accountGroups.edit', compact('accountGroup'));
    }

    public function update(Request $request, accountGroups $accountGroup)
    {
        $request->validate([
            'code' => 'required|integer',
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
            'is_active' => 'required|integer',
        ]);

        $accountGroup->update($request->all());
        return redirect('accountGroups')->with('success', 'Account Group updated successfully!');
    }

    public function destroy(accountGroups $accountGroup)
    {
        $accountGroup->delete();
        return redirect()->back()->with('success', 'Account Group deleted successfully!');
    }

}
