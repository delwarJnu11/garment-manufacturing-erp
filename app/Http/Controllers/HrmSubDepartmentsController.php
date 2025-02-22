<?php

namespace App\Http\Controllers;

use App\Models\Hrm_departments;
use App\Models\Hrm_statuses;
use App\Models\Hrm_sub_departments;
use Illuminate\Http\Request;

class HrmSubDepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Hrm_sub_departments::paginate(5);
         //print_r($departments);

        return view('pages.hrm.department.hrm_sub_department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=Hrm_statuses::all();
        $departments=Hrm_departments::all();
        return view('pages.hrm.department.hrm_sub_department.create', compact('status','departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'departments_id' => 'required|string|max:200'
        ]);

        $departments = new Hrm_sub_departments();
        $departments->name= $request->name;
        $departments->statuses_id= $request->statuses_id;
        $departments->departments_id= $request->departments_id;
        $departments->description= $request->description;

        if($departments->save()){
            return redirect()->back()->with('success', 'sub_departments has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_sub_departments $Hrm_sub_departments, $id)
    {
        $departments = Hrm_sub_departments::find($id);
        return view('pages.hrm.department.hrm_sub_department.show', compact('departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_sub_departments $Hrm_sub_departments, $id)
    {
        $departments = Hrm_sub_departments::find($id);
        $status = Hrm_statuses::all();
        $department=Hrm_departments::all();

        return view('pages.hrm.department.hrm_sub_department.update', compact('departments', 'status', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_sub_departments $Hrm_sub_departments, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'departments_id' => 'required|string|max:200'
        ]);

        $departments = Hrm_sub_departments::find($id);
        $departments->name= $request->name;
        $departments->statuses_id= $request->statuses_id;
        $departments->departments_id= $request->departments_id;
        $departments->description= $request->description;


        if($departments->save()){
            return redirect('Hrm_sub_departments')->with('success', 'Sub_departments has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_sub_departments $Hrm_sub_departments, $id)
    {

        $del = Hrm_sub_departments::destroy($id);
        if ($del) {
            return redirect('Hrm_sub_departments')->with('success', "departments has been Deleted");
        }
    }
}
