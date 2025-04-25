<?php

namespace App\Http\Controllers;

use App\Models\WastageType;
use Illuminate\Http\Request;

class WastageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wastageTypes = WastageType::paginate(4);

        return view('pages.production.wastages.wastageType.index', compact('wastageTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.production.wastages.wastageType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255|unique:wastage_types,name',
            'description' => 'nullable|string|max:1000',
        ], [
            'type_name.required' => 'Type Name is required!',
            'type_name.max' => 'Type Name should not be more than 255 characters.',
            'type_name.unique' => 'This Type Name already exists.',
            'description.max' => 'Description should not exceed 1000 characters.',
        ]);

        $result = WastageType::create([
            'name' => $request->type_name,
            'description' => $request->description
        ]);

        if ($result) {
            return redirect()->route('wastage-types.index')->with('success', 'Wastage type created successfully!');
        } else {
            return back()->withInput()->with('error', 'Failed to create wastage type. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WastageType $wastageType)
    {
        return view('pages.production.wastages.wastageType.show', compact('wastageType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WastageType $wastageType)
    {
        return view('pages.production.wastages.wastageType.edit', compact('wastageType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WastageType $wastageType)
    {
        // Validate input with unique rule ignoring current record
        $request->validate([
            'type_name' => 'required|string|max:255|unique:wastage_types,name,' . $wastageType->id,
            'description' => 'nullable|string|max:1000',
        ], [
            'type_name.required' => 'Type Name is required!',
            'type_name.max' => 'Type Name should not be more than 255 characters.',
            'type_name.unique' => 'This Type Name already exists.',
            'description.max' => 'Description should not exceed 1000 characters.',
        ]);

        // Update the wastage type
        $result = $wastageType->update([
            'name' => $request->type_name,
            'description' => $request->description,
        ]);

        if ($result) {
            return redirect()->route('wastage-types.index')
                ->with('success', 'Wastage type updated successfully!');
        } else {
            return back()->withInput()
                ->with('error', 'Failed to update wastage type. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WastageType $wastageType)
    {
        //
    }
}
