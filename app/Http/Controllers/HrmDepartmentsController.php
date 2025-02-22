<?php

namespace App\Http\Controllers;

use App\Models\Hrm_departments;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmDepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Hrm_departments::paginate(5);
         //print_r($departments);

        return view('pages.hrm.department.hrm_department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=Hrm_statuses::all();
        return view('pages.hrm.department.hrm_department.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200'
        ]);

        $departments = new Hrm_departments();
        $departments->name= $request->name;
        $departments->statuses_id= $request->statuses_id;
        $departments->description= $request->description;

        if($departments->save()){
            return redirect()->back()->with('success', 'departments has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_departments $Hrm_departments, $id)
    {
        $departments = Hrm_departments::find($id);
        return view('pages.hrm.department.hrm_department.show', compact('departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_departments $Hrm_departments, $id)
    {
        $departments = Hrm_departments::find($id);
        $status = Hrm_statuses::all();

        return view('pages.hrm.department.hrm_department.update', compact('departments', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_departments $Hrm_departments, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200'
        ]);

        $departments = Hrm_departments::find($id);
        $departments->name= $request->name;
        $departments->statuses_id= $request->statuses_id;
        $departments->description= $request->description;

        if($departments->save()){
            return redirect('hrm_departments')->with('success', 'departments has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_departments $Hrm_departments, $id)
    {

        $del = Hrm_departments::destroy($id);
        if ($del) {
            return redirect('hrm_departments')->with('success', "departments has been Deleted");
        }
    }
}
