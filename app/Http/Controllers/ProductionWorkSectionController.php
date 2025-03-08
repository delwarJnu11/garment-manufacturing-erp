<?php

namespace App\Http\Controllers;

use App\Models\ProductionWorkSection;
use Illuminate\Http\Request;

class ProductionWorkSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = ProductionWorkSection::all();
        return view('pages.production.production_work_order.production_work_section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.production.production_work_order.production_work_section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status_name' => 'required|string|max:50',
        ], [
            'required' => 'Staus name is required!',
        ]);

        // Create a new role
        ProductionWorkSection::create([
            'name' => $request->status_name,
        ]);

        return redirect()->route('production_work_sections.index')->with('success', 'Production Section has been added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionWorkSection $productionWorkSection)
    {
        return view('pages.production.production_work_order.production_work_section.show', compact('productionWorkSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionWorkSection $productionWorkSection)
    {
        return view('pages.production.production_work_order.production_work_section.edit', compact('productionWorkSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionWorkSection $productionWorkSection)
    {
        $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        $productionWorkSection->name = $request->status_name;
        $productionWorkSection->save();

        return redirect()->route('production_work_sections.index')->with('success', 'Production Section has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionWorkSection $productionWorkSection)
    {
        $productionWorkSection->delete();
        return redirect()->route('production_work_sections.index')->with('success', 'Production Section has been deleted successfully!');
    }
}
