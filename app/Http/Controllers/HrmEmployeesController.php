<?php

namespace App\Http\Controllers;

use App\Models\Hrm_departments;
use App\Models\Hrm_designations;
use App\Models\Hrm_employee_positions;
use App\Models\Hrm_employees;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Hrm_employees::paginate(5);
         //print_r($employees);

         return view('pages.hrm.employee.hrm_employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=Hrm_statuses::all();
        $departments=Hrm_departments::all();
        $positions=Hrm_employee_positions::all();
        $designations=Hrm_designations::all();
        return view('pages.hrm.employee.hrm_employee.create', compact('status','departments','positions','designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:50',
            'gender' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'joining_date' => 'required|date',
            'salary' => 'required|string|max:50',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'department_id' => 'required|string|max:200',
            'positions_id' => 'required|string|max:200',
            'designations_id' => 'required|string|max:200',
        ]);

        $employees = new Hrm_employees();
        $employees->name= $request->name;
        $employees->email= $request->email;
        $employees->phone= $request->phone;
        $employees->gender= $request->gender;
        $employees->date_of_birth= $request->date_of_birth;
        $employees->joining_date= $request->joining_date;
        $employees->positions_id= $request->positions_id;
        $employees->designations_id= $request->designations_id;
        $employees->salary= $request->salary;
        $employees->statuses_id= $request->statuses_id;
        $employees->department_id= $request->department_id;
        $employees->address= $request->address;
        $employees->city= $request->city;

        if($employees->save()){
            return redirect()->back()->with('success', 'Employee has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_employees $Hrm_employees, $id)
    {
        $employees = Hrm_employees::find($id);
        return view('pages.hrm.employee.hrm_employee.show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_employees $Hrm_employees, $id)
    {
        $employees = Hrm_employees::find($id);
        $status = Hrm_statuses::all();
        $departments=Hrm_departments::all();
        $positions=Hrm_employee_positions::all();
        $designations=Hrm_designations::all();
        return view('pages.hrm.employee.hrm_employee.update', compact('employees', 'status', 'departments','positions','designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_employees $Hrm_employees, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:50',
            'gender' => 'required|string|max:50',
            'date_of_birth' => 'required|date_format:Y-M-D|before:today',
            'joining_date' => 'required|date_format:d-m-Y',
            'salary' => 'required|string|max:50',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'department_id' => 'required|string|max:200',
            'positions_id' => 'required|string|max:200',
            'designations_id' => 'required|string|max:200',
        ]);

        $employees = Hrm_employees::find($id);
        $employees->name= $request->name;
        $employees->email= $request->email;
        $employees->phone= $request->phone;
        $employees->gender= $request->gender;
        $employees->date_of_birth= $request->date_of_birth;
        $employees->joining_date= $request->joining_date;
        $employees->positions_id= $request->positions_id;
        $employees->designations_id= $request->designations_id;
        $employees->salary= $request->salary;
        $employees->statuses_id= $request->statuses_id;
        $employees->department_id= $request->department_id;
        $employees->address= $request->address;
        $employees->city= $request->city;



        if($employees->save()){
            return redirect('hrm_employees')->with('success', 'employee has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_employees $Hrm_employees, $id)
    {

        $del = Hrm_employees::destroy($id);
        if ($del) {
            return redirect('hrm_employees')->with('success', "employee has been Deleted");
        }
    }
}

