<?php

namespace App\Http\Controllers\Api\vue;

use App\Http\Controllers\Controller;
use App\Models\InvSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $suppliersQuery = InvSupplier::with('bankAccount');
            if ($request->search) {
                $search = $request->search;
                $suppliersQuery->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                    $query->orWhere('last_name', 'like', '%' . $search . '%');
                    $query->orWhere('id', 'like', '%' . $search . '%');

                    $query->orWhereHas('bankAccount', function ($que) use ($search) {
                        $que->where('name', 'like', '%' . $search . '%');
                    });
                });
            }

            $suppliers = $suppliersQuery->paginate(4);
            return response()->json([
                'message' => 'Retrieve suppliers data successfully',
                'suppliers' => $suppliers
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["erro" => $th->getMessage()], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
