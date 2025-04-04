<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = Role::all();
            if (!$roles) {
                $roles = "No Data Found";
            }
            return response()->json(['roles' => $roles]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            return response()->json(['result' => $role->name]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            \Log::info("Fetching role with ID: " . $id);

            $role = Role::find($id);

            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            return response()->json(['role' => $role]);
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            $role->name = $request->name;
            $role->save();

            return response()->json(['roles' => $role]);
        } catch (\Throwable $th) {
            return response()->json(['err' => $th->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }
}
