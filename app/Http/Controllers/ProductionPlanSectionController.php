<?php

namespace App\Http\Controllers;

use App\Models\ProductionPlanSection;
use Illuminate\Http\Request;

class ProductionPlanSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = ProductionPlanSection::all();
        return view('pages.production.production_plan.production_plan_section.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.production.production_plan.production_plan_section.create');
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
    public function show(ProductionPlanSection $productionPlanSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionPlanSection $productionPlanSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionPlanSection $productionPlanSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionPlanSection $productionPlanSection)
    {
        //
    }
}
