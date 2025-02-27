<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_type;
use Illuminate\Http\Request;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_types = Category_type::with('category')->paginate(4);
        return view('pages.inventory.category.category_type.category_type', compact('category_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.inventory.category.category_type.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',

        ]);

        $categoriy_type = new Category_type();

        $categoriy_type->category_id  = $request->category_id;
        $categoriy_type->name  = $request->name;
        if ($categoriy_type->save()) {
            return redirect('categoryType')->with('success', 'Category Type Added Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
