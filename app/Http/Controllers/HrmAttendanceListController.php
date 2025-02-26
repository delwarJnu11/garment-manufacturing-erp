<?php

namespace App\Http\Controllers;

use App\Models\Hrm_attendances_lists;
use App\Models\Hrm_employees;
use Illuminate\Http\Request;

class HrmAttendanceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendences = Hrm_attendances_lists::all();
        //print_r($attendences);

         return view('pages.hrm.attendence.hrm_attendance_list.index', compact('attendences'));
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
        'date' => 'required|date',
        'statuses_id' => 'required|exists:hrm_statuses,id',
        'clock_in' => 'required|date_format:H:i:s',
        'clock_out' => 'required|date_format:H:i:s',
        'late_days' => 'required|integer|min:0',
        'leave_days' => 'required|integer|min:0',
        'overtime_hours' => 'required|numeric|min:0',
    ]);

        $attendences = new Hrm_attendances_lists();
        $attendences->employee_id= $request->employee_id;
        $attendences->date= $request->date;
        $attendences->statuses_id= $request->statuses_id;
        $attendences->clock_in= $request->clock_in;
        $attendences->clock_out= $request->clock_out;
        $attendences->late_days= $request->late_days;
        $attendences->leave_days= $request->leave_days;
        $attendences->overtime_hours= $request->overtime_hours;

        if($attendences->save()){
            return redirect()->back()->with('success', 'Employee Position has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_attendances_lists $Hrm_attendances_lists, $id)
    {
        $attendences = Hrm_attendances_lists::find($id);
        return view('pages.hrm.attendence.hrm_attendance_list.show', compact('attendences'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_attendances_lists $Hrm_attendance_list, $id)
    {
        $employees=Hrm_employees::all();
        $attendences = Hrm_attendances_lists::find($id);


        return view('pages.hrm.attendence.hrm_attendance_list.update', compact('attendences','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_attendances_lists $Hrm_attendances_lists, $id)
    {

        $request->validate([
            'employee_id' => 'required|string|max:50',
            'date' => 'required|date',
            'statuses_id' => 'required|exists:hrm_statuses,id',
            'clock_in' => 'required|date_format:H:i:s',
            'clock_out' => 'required|date_format:H:i:s',
            'late_days' => 'required|integer|min:0',
            'leave_days' => 'required|integer|min:0',
            'overtime_hours' => 'required|numeric|min:0',
        ]);

            $attendences = Hrm_attendances_lists::find($id);
            $attendences->employee_id= $request->employee_id;
            $attendences->date= $request->date;
            $attendences->statuses_id= $request->statuses_id;
            $attendences->clock_in= $request->clock_in;
            $attendences->clock_out= $request->clock_out;
            $attendences->late_days= $request->late_days;
            $attendences->leave_days= $request->leave_days;
            $attendences->overtime_hours= $request->overtime_hours;

        if($attendences->save()){
            return redirect('hrm_attendance_list')->with('success', 'attendences has been updated successfully!');
         } ;
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Hrm_attendances_lists $Hrm_attendances_lists, $id)
    {

        $del = Hrm_attendances_lists::destroy($id);
        if ($del) {
            return redirect('hrm_attendance_list')->with('success', "attendences has been Deleted");
        }
    }
}

