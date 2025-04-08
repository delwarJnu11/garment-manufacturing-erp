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
        $usersQuery = User::query();

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
            \Log::error($th->getMessage());
            return response()->json(['error' => 'Something went wrong', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::find($id);
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
    public function update(Request $request, string $id)
    {


        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->role_id = $request->role_id;
            $user->email = $request->email;
            $user->photo = $request->photo;
            $user->password = $request->password;
            $user->save();
            if (!$user) {
                return response()->json(["error" => "not data find"]);
            }
            return response()->json(['user' => $user]);
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
