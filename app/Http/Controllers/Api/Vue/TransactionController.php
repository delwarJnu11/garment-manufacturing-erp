<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(transactions::with(["Account", "AccountAgainst"])->get());
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
            $transaction = new transactions();
            // $transaction->id = $request->id;
            $transaction->name = $request->name;

            $transaction->save();
            return response()->json($transaction);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(transactions::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $transaction = new transactions();
            $transaction->id = $request->id;
            $transaction->name = $request->name;
            $transaction->updated_at = date('Y-m-d h:i:s');
            $transaction->save();
            return response()->json($transaction);
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
            $transaction = new transactions();
            $transaction->destroy($id);
            return response()->json(["Success" => "Transaction deleted successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["Error" => $th->getMessage()]);
        }
    }
}
