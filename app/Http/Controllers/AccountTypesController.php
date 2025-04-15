<?php

namespace App\Http\Controllers;

use App\Models\accountTypes;
use Illuminate\Http\Request;

class AccountTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountTypes = accountTypes::all();
        return view('pages.accounts.accountTypes.index', compact('accountTypes'));
    }

    // Show the form for creating a new account type
    public function create()
    {
        return view('pages.accounts.accountTypes.create');
    }

    // Store a newly created account type in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        accountTypes::create([
            'name' => $request->name,
        ]);

        return redirect('accountTypes')->with('success', 'Account Type created successfully');
    }

    // Show the form for editing the specified account type
    public function edit($id)
    {
        $accountType = accountTypes::findOrFail($id);
        return view('pages.accounts.accountTypes.edit', compact('accountType'));
    }

    // Update the specified account type in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $accountType = accountTypes::findOrFail($id);
        $accountType->update([
            'name' => $request->name,
        ]);

        return redirect()->route('pages.accounts.accountTypes.index')->with('success', 'Account Type updated successfully');
    }

    // Remove the specified account type from the database
    public function destroy($id)
    {
        $accountType = accountTypes::findOrFail($id);
        $accountType->delete();

        return redirect()->back()->with('success', 'Account Type deleted successfully');
    }
}
