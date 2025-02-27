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
        $categories = Category::paginate(7);
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
          
        ]);

        $categorie = new Category();

        $categorie->name  = $request->name;
        // $categorie->description  = $request->description;
        if ($categorie->save()) {
           return redirect('category')->with('success', 'Category Added Successfully');
        }
        return  redirect('category')->with('error', 'Something went wrong. Please try again.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('pages.inventory.category.category_list.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:4',
          
        ]);

        $category = Category::find($id);

        $category->name  = $request->name;
      

        if ($category->save()) {
            return redirect('category')->with('success', 'Category Updated Successfully');
        }

        return redirect('category')->with('error', 'Update failed');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('category')->with('success', 'Category deleted successfully');
    }
}
