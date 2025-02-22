<?php

namespace App\Http\Controllers;

use App\Models\UOM;
use Illuminate\Http\Request;

class UOMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uoms = UOM::paginate(10);
        return view('pages.inventory.uoms.index', compact('uoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.inventory.uoms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

        ]);
        UOM::create([
            "name" => $request->name
        ]);
        return redirect('uoms')->with('success', 'Units created sucessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(UOM $uOM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UOM $uom)
    {

        return view('pages.inventory.uoms.edit', compact('uom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UOM $uom)
    {
        $request->validate([

            'name' => 'required',

        ]);
        $uom->update([
            "name" => $request->name
        ]);
        return redirect('uoms')->with('success', 'Units created sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UOM $uom)
    {
        $uom->delete();
        return redirect('uoms')->with('success', 'Unit of Measurement deleted successfully');
    }
}
