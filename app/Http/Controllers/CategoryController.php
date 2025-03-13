<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('pages.inventory.category.category_list.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.inventory.category.category_list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'is_raw_material' => 'nullable|boolean', // Ensure it's a boolean (0 or 1)
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->is_raw_material = $request->has('is_raw_material') ? 1 : 0; // Handle checkbox

        if ($category->save()) {
            return redirect()->route('category.index')->with('success', 'Category Created Successfully');
        }

        return redirect()->route('category.index')->with('error', 'Something went wrong. Please try again.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('pages.inventory.category.category_list.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:4',
            'is_raw_material' => 'nullable|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->is_raw_material = $request->has('is_raw_material') ? 1 : 0;

        if ($category->save()) {
            return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
        }

        return redirect()->route('category.index')->with('error', 'Update failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
