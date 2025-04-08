<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class RoleController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Role::query();

            if ($request->search) {
                $query->where('name', 'like', "%{$request->search}%");
            }

            $roles = $query->paginate(3);

            if ($roles->isEmpty()) {
                return response()->json([
                    'roles' => [],
                    'success' => false,
                    'status' => 404,
                    'message' => 'No roles found.'
                ]);
            }

            return response()->json([
                'roles' => $roles,
                'success' => true,
                'status' => 200,
                'message' => 'Roles retrieved successfully.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Server Error: ' . $th->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            Role::create($request->all());

            return response()->json([
                'message' => 'Role created successfully.',
                'status' => 201,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create role.',
                'status' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            Log::info("Fetching role with ID: " . $id);

            $role = Role::find($id);

            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            return response()->json(['role' => $role]);
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $role->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'message' => 'Role updated successfully.',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to create role.',
                'status' => 500,
                'error' => $th->getMessage()
            ]);
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
