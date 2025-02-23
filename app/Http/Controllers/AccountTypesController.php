<?php

namespace App\Http\Controllers;

use App\Models\AccountTypes;
use Illuminate\Http\Request;

class AccountTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.accounts.accountTypes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountTypes $accountTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountTypes $accountTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountTypes $accountTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountTypes $accountTypes)
    {
        //
    }
}
