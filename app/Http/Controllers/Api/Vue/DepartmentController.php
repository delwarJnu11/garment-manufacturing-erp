<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Hrm_departments;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        try {
            $departments = Hrm_departments::query();

            if($search=trim($request->search)){
                $departments->where('name', 'like', "%{$search}%");
            }
            return response()->json(['department' => $departments->paginate(5)]);

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
            $departments = new Hrm_departments();
            $departments->name= $request->name;
            $departments->statuses_id= $request->statuses_id;
            $departments->description= $request->description;

            $departments->save();
            return response()->json(['res'=>$departments]);
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
            $departments = Hrm_departments::find($id);
            if(!$departments){
                $departments="No Data Found";
            }
            return response()->json(['res'=>$departments]);
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
            $departments =Hrm_departments::find($request->id);
            $departments->name= $request->name;
            $departments->statuses_id= $request->statuses_id;
            $departments->description= $request->description;

            $departments->save();
            return response()->json(['res'=>$departments]);
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
            $departments= Hrm_departments::destroy($id);
            return response()->json(['res'=>$departments]);
        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }

    }
}
