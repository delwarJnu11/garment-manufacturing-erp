<?php

namespace App\Http\Controllers;

use App\Models\inv_suppliers;
use Illuminate\Http\Request;

class InvSuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = inv_suppliers::paginate(5);
        return view('pages.inventory.Suppliers.suppliers', compact('suppliers'));
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
    public function show(inv_suppliers $inv_suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inv_suppliers $inv_suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inv_suppliers $inv_suppliers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inv_suppliers $inv_suppliers)
    {
        //
    }
}
