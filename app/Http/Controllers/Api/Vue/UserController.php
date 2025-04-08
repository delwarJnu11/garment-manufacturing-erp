<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(User::all());
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
            $user = new User();
            // $user->id = $request->id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;

            if ($request->files) {
                $user->image = $request->image;
            }
            $user->save();
            return response()->json($user);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(User::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;

            if ($request->files) {
                $user->image = $request->image;
            }
            $user->updated_at = date('Y-m-d h:i:s');
            $user->save();
            return response()->json($user);
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
            $user = new User();
            $user->destroy($id);
            return response()->json(["Success" => "User deleted successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["Error" => $th->getMessage()]);
        }
    }
}
