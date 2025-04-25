<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Size;
use App\Models\Uom;
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
                $categoryQuery->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('id', 'like', '%' . $request->search . '%');
                });
            }
            // Always paginate, whether search is applied or not
            $categories = $categoryQuery->paginate(5);
            return response()->json(['categories' => $categories]);
        } catch (\Throwable $th) {
            return response()->json(['err' => $th->getMessage()]);
        }
    }





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
            $category = Category::find($id);
            if (!$category) {
                return response()->json(['error' => "No data found"], 404);
            }
            return response()->json(['category' => $category], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $category = Category::find($id);
            if (!$category) {
                return response()->json(['error' => 'Category not found'], 404);
            }
            $request->validate([
                "name" => 'required|min:4|string',
                "is_raw_material" => 'nullable|boolean',
            ]);


            Log::info('Updating Category', ['category_id' => $category->id, 'request_data' => $request->all()]);
            $updated = $category->update([
                "name" => $request->name,
                "is_raw_material" => $request->isRawMaterial ? 1 : 0
            ]);
            if (!$updated) {
                return response()->json(["error" => "Failed to update"], 500);
            }

            return response()->json(['success' => 'Updated successfully'], 200);
        } catch (\Throwable $th) {
            Log::error('Update failed: ' . $th->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function all()
    {
        $categories = Category::all(); // fetch all, no pagination
        return response()->json([
            'categories' => $categories
        ]);
    }
    public function size()
    {
        $sizes = Size::all(); // fetch all, no pagination
        return response()->json([
            'sizes' => $sizes
        ]);
    }
    public function uom()
    {
        $uoms = Uom::all(); // fetch all, no pagination
        return response()->json([
            'uoms' => $uoms
        ]);
    }
    
    
}
