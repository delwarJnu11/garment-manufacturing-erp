<?php

namespace App\Http\Controllers;

use App\Models\Hrm_employee_timesheets;
use App\Models\Hrm_employees;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmEmployeeTimesheetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timesheets = Hrm_employee_timesheets::paginate(10);
        //print_r($timesheets);

         return view('pages.hrm.hrm_timesheets.index', compact('timesheets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees=Hrm_employees::all();
        $statuses=Hrm_statuses::all();
        return view('pages.hrm.hrm_timesheets.create', compact('employees','statuses'));
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
        'shift_start' => 'required|integer|min:0',
        'shift_end' => 'required|integer|min:0',
        'break_duration' => 'required|numeric|min:0',
        'total_work_hours' => 'required|numeric|min:0',
        'fixed_work_hours' => 'required|numeric|min:0',
        'overtime_hours' => 'required|numeric|min:0',
        'remarks' => 'required|numeric|min:0',
    ]);

        $timesheets = new Hrm_employee_timesheets();
        $timesheets->employee_id= $request->employee_id;
        $timesheets->date= $request->date;
        $timesheets->statuses_id= $request->statuses_id;
        $timesheets->clock_in= $request->clock_in;
        $timesheets->clock_out= $request->clock_out;
        $timesheets->shift_start= $request->shift_start;
        $timesheets->shift_end= $request->shift_end;
        $timesheets->break_duration= $request->break_duration;
        $timesheets->total_work_hours= $request->total_work_hours;
        $timesheets->fixed_work_hours= $request->fixed_work_hours;
        $timesheets->overtime_hours= $request->overtime_hours;
        $timesheets->remarks= $request->remarks;

        if($timesheets->save()){
            return redirect()->back()->with('success', 'Employee Position has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_employee_timesheets $Hrm_employee_timesheets, $id)
    {
        $timesheets = Hrm_employee_timesheets::find($id);
        return view('pages.hrm.hrm_timesheets.show', compact('timesheets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_employee_timesheets $Hrm_attendance_list, $id)
    {
        $employees=Hrm_employees::all();
        $timesheets = Hrm_employee_timesheets::find($id);


        return view('pages.hrm.hrm_timesheets.update', compact('timesheets','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_employee_timesheets $Hrm_employee_timesheets, $id)
    {

        $request->validate([
            'employee_id' => 'required|string|max:50',
            'date' => 'required|date',
            'statuses_id' => 'required|exists:hrm_statuses,id',
            'clock_in' => 'required|date_format:H:i:s',
            'clock_out' => 'required|date_format:H:i:s',
            'shift_start' => 'required|integer|min:0',
            'shift_end' => 'required|integer|min:0',
            'break_duration' => 'required|numeric|min:0',
            'total_work_hours' => 'required|numeric|min:0',
            'overtime_hours' => 'required|numeric|min:0',
            'remarks' => 'required|numeric|min:0',
        ]);

            $timesheets = Hrm_employee_timesheets::find($id);
            $timesheets->employee_id= $request->employee_id;
            $timesheets->date= $request->date;
            $timesheets->statuses_id= $request->statuses_id;
            $timesheets->clock_in= $request->clock_in;
            $timesheets->clock_out= $request->clock_out;
            $timesheets->shift_start= $request->shift_start;
            $timesheets->shift_end= $request->shift_end;
            $timesheets->break_duration= $request->break_duration;
            $timesheets->total_work_hours= $request->total_work_hours;
            $timesheets->overtime_hours= $request->overtime_hours;
            $timesheets->remarks= $request->remarks;

        if($timesheets->save()){
            return redirect('hrm_employee_timesheets')->with('success', 'timesheets has been updated successfully!');
         } ;
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Hrm_employee_timesheets $Hrm_employee_timesheets, $id)
    {

        $del = Hrm_employee_timesheets::destroy($id);
        if ($del) {
            return redirect('hrm_employee_timesheets')->with('success', "timesheets has been Deleted");
        }
    }
}
