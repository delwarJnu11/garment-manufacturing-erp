<?php

namespace App\Http\Controllers;

use App\Models\category_attributes;
use Illuminate\Http\Request;

class CategoryAttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_attributes = category_attributes::paginate(4);
        return view('pages.inventory.category.category_attributes.category_attributes', compact('category_attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.inventory.category.category_attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'category_id' => 'required',
            'category_type' => 'required',
            'name' => 'required',
            'attribute_value' => 'required',
        ]);

        $category_attribute = new category_attributes();
        $category_attribute->category_id = $request->category_id;
        $category_attribute->category_type_id = $request->category_type;
        $category_attribute->name = $request->name;
        $category_attribute->attribute_value = $request->attribute_value;

        if ($category_attribute->save()) {
            return  redirect('category')->with('success', 'Category Added Successfully');
        }
        return redirect('category')->with('error', 'Somthing Went wrong');
    }

    /**
     * Display the specified resource.
     */
    public function show(category_attributes $category_attributes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category_attributes $category_attributes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category_attributes $category_attributes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category_attributes $category_attributes)
    {
        //
    }
}
