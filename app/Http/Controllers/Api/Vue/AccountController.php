<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(Account::all());
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
            $account = new Account();
            // $account->id = $request->id;
            $account->name = $request->name;
            $account->email = $request->email;
            $account->role_id = $request->role_id;
            $account->save();
            return response()->json($account);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Account::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, string $id)
    {
        try {
            $account = new Account();
            $account->id = $request->id;
            $account->name = $request->name;
            $account->email = $request->email;
            $account->role_id = $request->role_id;

            if ($request->files) {
                $account->image = $request->image;
            }
            $account->updated_at = date('Y-m-d h:i:s');
            $account->save();
            return response()->json($account);
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
            $account = new Account();
            $account->destroy($id);
            return response()->json(["Success" => "User deleted successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["Error" => $th->getMessage()]);
        }
    }
}
