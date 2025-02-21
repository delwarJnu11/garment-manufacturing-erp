<?php

namespace App\Http\Controllers;

use App\Models\Valuation_methods;
use Illuminate\Http\Request;

class ValuationMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $valuations = Valuation_methods::all();
        return view('pages.inventory.valuations.index', compact('valuations'));
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
    public function show(Valuation_methods $valuation_methods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Valuation_methods $valuation_methods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Valuation_methods $valuation_methods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Valuation_methods $valuation_methods)
    {
        //
    }
}
