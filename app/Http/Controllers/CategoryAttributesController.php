<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\category_attributes;
use App\Models\Category_type;
use Illuminate\Http\Request;

class CategoryAttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_attributes = category_attributes::with('category', 'category_type')->paginate(4);
        return view('pages.inventory.category.category_attributes.category_attributes', compact('category_attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $category_type = Category_type::all();
        return view('pages.inventory.category.category_attributes.create', compact('category', 'category_type'));
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
    public function show(string $id)
    {
        $categoryattribute = category_attributes::findOrFail($id);
        return view('pages.inventory.category.category_attributes.show', compact('categoryattribute'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $category_attribute = category_attributes::find($id);
        return view('pages.inventory.category.category_attributes.edit', compact('category_attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'category_id' => 'required',
            'category_type' => 'required',
            'name' => 'required',
            'attribute_value' => 'required',
        ]);


        $category_attribute = category_attributes::find($id);
        $category_attribute->category_id = $request->category_id;
        $category_attribute->category_type_id = $request->category_type;
        $category_attribute->name = $request->name;
        $category_attribute->attribute_value = $request->attribute_value;

        if ($category_attribute->save()) {
            return  redirect('category')->with('success', 'Category Updated Successfully');
        }
        return  redirect('category')->with('error', 'Somthing Went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = category_attributes::find($id);

        if (!$category) {
            return redirect('category')->with('error', 'Category Not Found');
        }

        $category->delete();

        return redirect('category')->with('success', 'Category Deleted Successfully');
    }
}
