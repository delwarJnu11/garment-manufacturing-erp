<?php

namespace App\Http\Controllers;

use App\Models\Hrm_attendances_lists;
use App\Models\Hrm_employee_timesheets;
use App\Models\Hrm_employees;
use App\Models\Hrm_statuses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrmAttendanceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendences = Hrm_attendances_lists::paginate(10);
        //  echo   "<pre>";
        //  print_r(Auth::user()->id);
        // print_r(Auth::user());

        return view('pages.hrm.attendence.hrm_attendance_list.index', compact('attendences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Hrm_employees::all();
        $statuses = Hrm_statuses::all();
        return view('pages.hrm.attendence.hrm_attendance_list.create', compact('employees', 'statuses'));
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
            'late_times' => 'required|integer|min:0',
            'leave_times' => 'required|integer|min:0',
            'total_work_hours' => 'required|numeric|min:0',
            'overtime_hours' => 'required|numeric|min:0',
        ]);

        $attendences = new Hrm_attendances_lists();
        $attendences->employee_id = $request->employee_id;
        $attendences->date = $request->date;
        $attendences->statuses_id = $request->statuses_id;
        $attendences->clock_in = $request->clock_in;
        $attendences->clock_out = $request->clock_out;
        $attendences->late_days = $request->late_days;
        $attendences->leave_days = $request->leave_days;
        $attendences->late_times = $request->late_times;
        $attendences->leave_times = $request->leave_times;
        $attendences->total_work_hours = $request->total_work_hours;
        $attendences->overtime_hours = $request->overtime_hours;

        if ($attendences->save()) {
            return redirect()->back()->with('success', 'Employee Position has been added successfully!');
        };
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
        $employees = Hrm_employees::all();
        $attendences = Hrm_attendances_lists::find($id);


        return view('pages.hrm.attendence.hrm_attendance_list.update', compact('attendences', 'employees'));
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
            'late_times' => 'required|integer|min:0',
            'leave_times' => 'required|integer|min:0',
            'total_work_hours' => 'required|numeric|min:0',
            'overtime_hours' => 'required|numeric|min:0',
        ]);

        $attendences = Hrm_attendances_lists::find($id);
        $attendences->employee_id = $request->employee_id;
        $attendences->date = $request->date;
        $attendences->statuses_id = $request->statuses_id;
        $attendences->clock_in = $request->clock_in;
        $attendences->clock_out = $request->clock_out;
        $attendences->late_days = $request->late_days;
        $attendences->leave_days = $request->leave_days;
        $attendences->late_times = $request->late_times;
        $attendences->leave_times = $request->leave_times;
        $attendences->total_work_hours = $request->total_work_hours;
        $attendences->overtime_hours = $request->overtime_hours;

        if ($attendences->save()) {
            return redirect('hrm_attendance_list')->with('success', 'attendences has been updated successfully!');
        };
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






    public function clockIn(Request $request)
    {

        $attendences = new Hrm_attendances_lists();

        $attendences->employee_id = Auth::user()->id;
        $attendences->date = Carbon::today()->toDateString();
        $attendences->statuses_id = 7;
        $attendences->clock_in = Carbon::now('Asia/Dhaka')->format('h:i:s');
        $attendences->clock_out = null;
        $attendences->save();

            $timesheet= new Hrm_employee_timesheets();
            $timesheet->employee_id = Auth::user()->id;
            $timesheet->date = Carbon::today()->toDateString();
            $timesheet->statuses_id = 7;
            $timesheet->clock_in = Carbon::now('Asia/Dhaka')->format('h:i:s');
            $timesheet->clock_out = null;
            $timesheet->shift_start ="10:00:00";
            $timesheet->shift_end ="06:00:00";
            $timesheet->break_duration =0;
            $timesheet->total_work_hours=0;
            $timesheet->overtime_hours=0;
            $timesheet->remarks=$request->remarks;

            $timesheet->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Clocked In successfully.',
        ]);
    }

    // Clock Out
    public function clockOut(Request $request)
    {

        $employee_id = Auth::user()->id;
        $attendance = Hrm_attendances_lists::where('employee_id', $employee_id)
            ->whereDate('date', Carbon::today()->toDateString())
            ->orderBy('id', 'desc')
            ->first();

        $attendences = Hrm_attendances_lists::find($attendance->id);
        $attendences->clock_out = Carbon::now('Asia/Dhaka')->format('h:i:s');
        $attendences->total_work_hours = $this->calculatetotal_work_hours($attendences->clock_in, $attendences->clock_out);
        $attendences->overtime_hours = $this->calculateOvertime($attendences->clock_in, $attendences->clock_out);

        if ($attendences->save()) {
           Hrm_attendances_lists::find($attendance->id);
        };

        // Timesheets

        $employee_id = Auth::user()->id;
        $timesheet = Hrm_employee_timesheets::where('employee_id', $employee_id)
            ->whereDate('date', Carbon::today()->toDateString())
            ->orderBy('id', 'desc')
            ->first();

        $timesheets = Hrm_employee_timesheets::find($timesheet->id);
        $timesheets->clock_out = Carbon::now('Asia/Dhaka')->format('h:i:s');
        $timesheets->total_work_hours = $this->calculatetotal_work_hours($timesheets->clock_in, $timesheets->clock_out);
        $timesheets->overtime_hours = $this->calculateOvertime($timesheets->clock_in, $timesheets->clock_out);


        if ($timesheets->save()) {
            Hrm_employee_timesheets::find($timesheet->id);
        };


        return response()->json([
            'status' => 'success',
            'message' => 'Clocked Out successfully.',

        ]);
    }


    private function calculateOvertime($clock_in, $clock_out)
    {
        $shift_start = Carbon::parse($clock_in);
        $shift_end = Carbon::parse($clock_out);

        $total_work_minutes = $shift_start->diffInMinutes($shift_end);

        $overtime_minutes = max(0, $total_work_minutes - 480);

        $overtime_hours = $overtime_minutes / 60;

        return $overtime_hours;
    }



    private function calculatetotal_work_hours($clock_in, $clock_out)
{
    $shift_start = Carbon::parse($clock_in);
    $shift_end = Carbon::parse($clock_out);

    $total_work_minutes = $shift_start->diffInMinutes($shift_end);


    $total_work_hours = $total_work_minutes / 60;

    return $total_work_hours;
}





}
