<?php

namespace App\Http\Controllers;

use App\Models\Hrm_departments;
use App\Models\Hrm_employee_positions;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmEmployeePositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Hrm_employee_positions::paginate(5);
         //print_r($designations);

         return view('pages.hrm.employee.hrm_employee_position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=Hrm_statuses::all();
        $departments=Hrm_departments::all();
        return view('pages.hrm.employee.hrm_employee_position.create', compact('status','departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'salary' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'department_id' => 'required|string|max:200'
        ]);

        $positions = new Hrm_employee_positions();
        $positions->name= $request->name;
        $positions->salary= $request->salary;
        $positions->statuses_id= $request->statuses_id;
        $positions->department_id= $request->department_id;
        $positions->description= $request->description;

        if($positions->save()){
            return redirect()->back()->with('success', 'Employee Position has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_employee_positions $Hrm_employee_positions, $id)
    {
        $positions = Hrm_employee_positions::find($id);
        return view('pages.hrm.employee.hrm_employee_position.show', compact('positions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_employee_positions $Hrm_employee_positions, $id)
    {
        $positions = Hrm_employee_positions::find($id);
        $status = Hrm_statuses::all();
        $departments=Hrm_departments::all();

        return view('pages.hrm.employee.hrm_employee_position.update', compact('positions', 'status', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_employee_positions $Hrm_employee_positions, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'salary' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'department_id' => 'required|string|max:200'
        ]);

        $positions = Hrm_employee_positions::find($id);
        $positions->name= $request->name;
        $positions->salary= $request->salary;
        $positions->statuses_id= $request->statuses_id;
        $positions->department_id= $request->department_id;
        $positions->description= $request->description;


        if($positions->save()){
            return redirect('hrm_employee_positions')->with('success', 'positions has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_employee_positions $Hrm_employee_positions, $id)
    {

        $del = Hrm_employee_positions::destroy($id);
        if ($del) {
            return redirect('hrm_employee_positions')->with('success', "Position has been Deleted");
        }
    }
}

