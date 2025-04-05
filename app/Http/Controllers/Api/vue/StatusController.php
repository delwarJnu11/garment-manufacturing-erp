<?php

namespace App\Http\Controllers\Api\vue;

use App\Http\Controllers\Controller;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            try {
                $statuses = Hrm_statuses::all();
                if(!$statuses){
                    $statuses = "Data Not Found";
                }
                return response()->json(['statuses' => $statuses]);
            } catch (\Throwable $th) {
                return response()->json(['statuses' => $th->getMessage()]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $statuses = new Hrm_statuses();
            $statuses->name = $request->name;
            $statuses->description = $request->description;
            $statuses->save() ;

            return response()->json(['res' => $statuses]);
        } catch (\Throwable $th) {
            return response()->json(['err' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $statuses = Hrm_statuses::find($id);
            if(!$statuses){
                $statuses = "Data Not Found";
            }
            return response()->json(['statuses' => $statuses]);
        } catch (\Throwable $th) {
            return response()->json(['statuses' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $statuses = Hrm_statuses::find($request->id);
            $statuses->name = $request->name;
            $statuses->description = $request->description;
            $statuses->save() ;

            return response()->json(['res' => $statuses]);
        } catch (\Throwable $th) {
            return response()->json(['err' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $statuses = Hrm_statuses::destroy($id);
            return response()->json(['res' => $statuses]);
        } catch (\Throwable $th) {
            return response()->json(['err' => $th->getMessage()]);
        }
    }
}
