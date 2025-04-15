<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(Role::all());
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        // return date('Y-m-d h:i:s');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $role = new Role();
            // $role->id = $request->id;
            $role->name = $request->name;
            $role->save();
            return response()->json($role);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Role::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $role = new Role();
            $role->id = $request->id;
            $role->name = $request->name;
            $role->updated_at = date('Y-m-d h:i:s');
            $role->save();
            return response()->json($role);
        } catch (\Throwable $th) { 
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = new Role();
            $role->destroy($id);
            return response()->json(["Success" => "User deleted successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["Error" => $th->getMessage()]);
        }
    }
}
