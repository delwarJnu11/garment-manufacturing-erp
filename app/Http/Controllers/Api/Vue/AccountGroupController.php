<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\AccountGroup;
use App\Models\AccountGroups;
use Illuminate\Http\Request;

class AccountGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(AccountGroups::all());
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
            $accountGroup = new AccountGroup();
            // $accountGroup->id = $request->id;
            $accountGroup->name = $request->name;
            $accountGroup->email = $request->email;
            $accountGroup->role_id = $request->role_id;

            if ($request->files) {
                $accountGroup->image = $request->image;
            }
            $accountGroup->save();
            return response()->json($accountGroup);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(AccountGroups::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $accountGroup = new AccountGroup();
            $accountGroup->id = $request->id;
            $accountGroup->name = $request->name;
            $accountGroup->email = $request->email;
            $accountGroup->role_id = $request->role_id;

            if ($request->files) {
                $accountGroup->image = $request->image;
            }
            $accountGroup->updated_at = date('Y-m-d h:i:s');
            $accountGroup->save();
            return response()->json($accountGroup);
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
            $accountGroup = new AccountGroup();
            $accountGroup->destroy($id);
            return response()->json(["Success" => "Account Group deleted successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["Error" => $th->getMessage()]);
        }
    }
}
