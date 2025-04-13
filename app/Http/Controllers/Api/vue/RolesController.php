<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
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

    public function show(string $id)
    {
        try {
            $role = Role::find($id);
            if (!$role) {
                return response()->json(['error' => 'No data found'], 404);
            }
            return response()->json(['success' => $role], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $role = Role::findOrFail($request->id);
            if ($role) {
                $res = $role->update([
                    'name' => $request->name,
                ]);

                if ($res) {
                    return response()->json([
                        'message' => 'Role updated successfully.',
                        'status' => 200,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Can not update Role',
                        'status' => 403,
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'Role Not Found',
                    'status' => 404,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to create role.',
                'status' => 500,
                'error' => $th->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json([
                    'message' => 'Role not found.',
                    'status' => 404,
                ]);
            }

            $role->delete();

            return response()->json([
                'message' => 'Role deleted successfully.',
                'status' => 200,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to delete role.',
                'status' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }
}
