<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $usersQuery = User::query();
        $usersQuery = User::with('role');

        if ($request->search) {
            $usersQuery->where('name', 'like', '%' . $request->search . '%');
        }
        $users = $usersQuery->paginate(3);
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:4|string",
            "role_id" => "required|integer",
            "email" => "required|email|string|unique:users,email",
            "password" => "required|string|confirmed|min:6",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
        ]);
        try {
            $user = new User;
            $user->name = $request->name;
            $user->role_id = $request->role_id;
            $user->email = $request->email;
            $user->password = Hash::make($request['password']);

            date_default_timezone_set("Asia/Dhaka");
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');

            if (isset($request->image)) {
                $user->image = $request->image;
            }
            $user->save();
            if (isset($request->image)) {
                $imageName = $user->id . '.' . $request->image->extension();
                $user->image = $imageName;
                $user->update();
                $request->image->move(public_path('uploads/users'), $imageName);
            }
            return response()->json(['users' => $user], 201);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => 'Something went wrong', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::with('role')->find($id);
            if (!$user) {
                return response()->json(["error" => "not data find"]);
            }
            return response()->json(['user' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Validation rule for image
        ]);

        try {
            // Update user details
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->role_id = $validatedData['role_id'];

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($user->image && file_exists(public_path('uploads/users/' . $user->image))) {
                    unlink(public_path('uploads/users/' . $user->image)); // Remove old image file
                }

                $imageName = time() . '_' . $user->id . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/users'), $imageName); // Move image to the directory
                $user->image = $imageName; // Update the image field in DB
            }

            $user->save(); // Save the user with the updated data

            return response()->json(['message' => 'User updated successfully', 'user' => $user]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => $th->getMessage()], 500); // Return error with status code 500
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id); // throws 404 if not found
            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'error' => 'Something went wrong',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
