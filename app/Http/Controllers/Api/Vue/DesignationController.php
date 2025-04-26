<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Hrm_designations;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        try {
            $designations = Hrm_designations::query();

            if($search=trim($request->search)){
                $designations->where('name', 'like', "%{$search}%");
            }
            return response()->json(['res' => $designations->paginate(2)]);

        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $designations = new Hrm_designations();
            $designations->name= $request->name;
            $designations->statuses_id= $request->statuses_id;
            $designations->department_id= $request->department_id;
            $designations->description= $request->description;

            $designations->save();
            return response()->json(['res'=>$designations]);
        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $designations = Hrm_designations::find($id);
            if(!$designations){
                $designations="No Data Found";
            }
            return response()->json(['res'=>$designations]);
        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $designations =Hrm_designations::find($request->id);
            $designations->name= $request->name;
            $designations->statuses_id= $request->statuses_id;
            $designations->department_id= $request->department_id;
            $designations->description= $request->description;

            $designations->save();
            return response()->json(['res'=>$designations]);
        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $designations= Hrm_designations::destroy($id);
            return response()->json(['res'=>$designations]);
        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }

    }
}
