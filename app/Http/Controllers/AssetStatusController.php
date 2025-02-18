<?php

namespace App\Http\Controllers;

use App\Models\asset_status;
use Illuminate\Http\Request;

class AssetStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.accounts.assetRegister');
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
    public function show(asset_status $asset_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asset_status $asset_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, asset_status $asset_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asset_status $asset_status)
    {
        //
    }
}
