<?php

namespace App\Http\Controllers;

use App\Models\FabricType;
use Illuminate\Http\Request;

class FabricTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fabrics_types = FabricType::paginate(4);
        return view('pages.orders_&_buyers.fabric_type.index', compact('fabrics_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.orders_&_buyers.fabric_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        FabricType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('fabric_types.index')->with('success', 'Fabrics type has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FabricType $fabricType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FabricType $fabricType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FabricType $fabricType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FabricType $fabricType)
    {
        //
    }
}
