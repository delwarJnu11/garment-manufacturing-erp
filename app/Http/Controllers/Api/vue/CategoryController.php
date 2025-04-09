<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
        try {
            $categoryQuery = Category::query();

            // If there's a search term, apply filter
            if ($request->search) {
                $categoryQuery->where('name', 'like', '%' . $request->search . '%');
            }

            // Always paginate, whether search is applied or not
            $categories = $categoryQuery->paginate(5);

            return response()->json(['categories' => $categories]);

        } catch (\Throwable $th) {
            return response()->json(['err' => $th->getMessage()]);
        }
    }
   

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     try {
           
    //         $request->validate([
    //             'name'=>'required|string|min:4',
    //             'is_raw_material'=>'nullable|boolean'
    //         ]);
    //         $category = new Category();
    //         $category->name = $request->name;

    //         $category->is_raw_material= $request->has('is_raw_material') ? 1 :0;
    
    //         if ($category->save()) {
    //             return redirect()->route('category.index')->with('success', 'Category Created Successfully');
    //         }
          
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         return response()->json(['error' => 'Something went wrong', 'message' => $th->getMessage()], 500);
    //     }
    // }

    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|min:4',
            'is_raw_material' => 'nullable|boolean'
        ]);

        $category = new Category();
        $category->name = $request->name;
        // When the checkbox is checked, the input is set to true; otherwise false.
        $category->is_raw_material = $request->has('is_raw_material') ? 1 : 0;
        
        if ($category->save()) {
            // Instead of redirecting, return JSON
            return response()->json([
                'success' => 'Category Created Successfully',
                'category' => $category
            ]);
        }
        
        return response()->json(['error' => 'Unable to create category'], 500);
      
    } catch (\Throwable $th) {
        Log::error($th->getMessage());
        return response()->json([
            'error' => 'Something went wrong',
            'message' => $th->getMessage()
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
          
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        try {
           
            // $user->save();
            if ('') {
                return response()->json(["error" => "not data find"]);
            }
            return response()->json(['user' => '']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
