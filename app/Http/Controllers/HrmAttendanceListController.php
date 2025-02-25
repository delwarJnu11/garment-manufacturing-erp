<?php

namespace App\Http\Controllers;

use App\Models\Hrm_attendance_list;
use App\Models\Hrm_employees;
use Illuminate\Http\Request;

class HrmAttendanceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendences = Hrm_attendance_list::all();
         print_r($attendences );

         //return view('pages.hrm.attendence.hrm_attendance_list.index', compact('attendences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees=Hrm_employees::all();
        return view('pages.hrm.attendence.hrm_attendance_list.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string|max:50',
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:200',
            'bank_identifier_code' => 'required|string|max:200',
            'branch_name' => 'required|string|max:200',
            'branch_location' => 'required|string|max:200',
        ]);

        $attendences = new Hrm_attendance_list();
        $attendences->employee_id= $request->employee_id;
        $attendences->bank_name= $request->bank_name;
        $attendences->account_number= $request->account_number;
        $attendences->bank_identifier_code= $request->bank_identifier_code;
        $attendences->branch_name= $request->branch_name;
        $attendences->branch_location= $request->branch_location;

        if($attendences->save()){
            return redirect()->back()->with('success', 'Employee Position has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_attendance_list $Hrm_attendance_list, $id)
    {
        $attendences = Hrm_attendance_list::find($id);
        return view('pages.hrm.attendence.hrm_attendance_list.show', compact('attendences'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_attendance_list $Hrm_attendance_list, $id)
    {
        $employees=Hrm_employees::all();
        $attendences = Hrm_attendance_list::find($id);


        return view('pages.hrm.attendence.hrm_attendance_list.update', compact('attendences','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_attendance_list $Hrm_attendance_list, $id)
    {

        $request->validate([
            'employee_id' => 'required|string|max:50',
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:200',
            'bank_identifier_code' => 'required|string|max:200',
            'branch_name' => 'required|string|max:200',
            'branch_location' => 'required|string|max:200',
        ]);

        $attendences = Hrm_attendance_list::find($id);
        $attendences->employee_id= $request->employee_id;
        $attendences->bank_name= $request->bank_name;
        $attendences->account_number= $request->account_number;
        $attendences->bank_identifier_code= $request->bank_identifier_code;
        $attendences->branch_name= $request->branch_name;
        $attendences->branch_location= $request->branch_location;

        if($attendences->save()){
            return redirect('hrm_attendance_list')->with('success', 'attendences has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_attendance_list $Hrm_attendance_list, $id)
    {

        $del = Hrm_attendance_list::destroy($id);
        if ($del) {
            return redirect('hrm_attendance_list')->with('success', "attendences has been Deleted");
        }
    }
}

