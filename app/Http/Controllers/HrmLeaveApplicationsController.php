<?php

namespace App\Http\Controllers;

use App\Models\Hrm_attendances_lists;
use App\Models\Hrm_employees;
use App\Models\Hrm_leave_application_approvers;
use App\Models\Hrm_leave_applications;
use App\Models\Hrm_leave_types;
use App\Models\Hrm_statuses;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HrmLeaveApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $applications = Hrm_leave_applications::paginate(10);
        //print_r();

        return view('pages.hrm.leave.hrm_leave_applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $status = Hrm_statuses::all();
        $employees = Hrm_employees::all();
        $leave_types = Hrm_leave_types::all();
        $approvers = Hrm_leave_application_approvers::all();
        return view('pages.hrm.leave.hrm_leave_applications.create', compact('status', 'leave_types', 'approvers', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'employee_id' => 'required|numeric',
        //     'attendance_id' => 'required|numeric',
        //    'leave_type_id' => 'required|numeric',
        //     'date' => 'required|date',
        //     'start_date' => 'required|date|after_or_equal:date',
        //     'end_date' => 'required|date|after_or_equal:start_date',
        //     // 'number_of_days' => 'required|integer|min:1',
        //     'reason' => 'required|string|max:200',
        //     'duration' => 'required|string|max:200',
        //     'statuses_id' => 'required|numeric',
        //     // 'approver_id' => 'required|numeric',
        //     'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        // ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/employee'), $fileName);
            $photoPath = 'uploads/employee/' . $fileName;
        }


        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);

        $start = new DateTime($startDate);
        $end = new DateTime($endDate);

        // Calculate the difference between the two dates
        $numOfDays = $start->diff($end);

        // The 'days' property gives the total number of days in the difference
        // echo $numOfDays->days+1;

        $applications = new Hrm_leave_applications();
        $applications->employee_id = $request->employee_id;
        $applications->attendance_id = $request->attendance_id;
        $applications->	leave_type_id = $request->	leave_type_id;
        $applications->date = $request->date;
        $applications->start_date = $startDate;
        $applications->end_date = $endDate;
        $applications->number_of_days=$numOfDays->days+1;
        $applications->	reason = $request->	reason;
        $applications->duration = $request->duration;
        $applications->statuses_id = $request->statuses_id;
        // $applications->approver_id = $request->approver_id;
        $applications->photo = $photoPath;


        // Save performance and handle the redirect
        if ($applications->save()) {
            return redirect()->back()->with('success', 'Leave Application has been added successfully!');
        }else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }







    /**
     * Display the specified resource.
     */
    public function show(Hrm_leave_applications $Hrm_leave_applications, $id)
    {
        $applications = Hrm_leave_applications::find($id);
        return view('pages.hrm.leave.hrm_leave_applications.show', compact('applications'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_leave_applications $Hrm_leave_applications, $id)
    {
        $applications = Hrm_leave_applications::find($id);
        $status = Hrm_statuses::all();
        $employees = Hrm_employees::all();
        $leave_types = Hrm_leave_types::all();
        $approvers = Hrm_leave_application_approvers::all();
        return view('pages.hrm.leave.hrm_leave_applications.update', compact('applications', 'status', 'leave_types', 'approvers', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_leave_applications $Hrm_leave_applications, $id)
    {

        $request->validate([
            'employees_id' => 'required|string|max:50',
            'attendance_id' => 'required|string|max:50',
            'leave_type_id' => 'required|string|max:200',
            'date' => 'required|string|max:200',
            'start_date' => 'required|string|max:200',
            'end_date' => 'required|string|max:200',
            // 'number_of_days	' => 'required|string|max:200',
            'reason' => 'required|string|max:200',
            'duration' => 'required|numeric',
            'statuses_id' => 'required|numeric',
            'approver_id' => 'required|numeric',
            'photo' => 'required|string|max:200',
        ]);

        $applications = Hrm_leave_applications::find($id);
        $applications->employees_id = $request->employees_id;
        $applications->attendance_id = $request->attendance_id;
        $applications->leave_type_id = $request->leave_type_id;
        $applications->date = $request->date;
        $applications->start_date = $request->start_date;
        $applications->end_date = $request->end_date;
        $applications->number_of_days     = $request->number_of_days;
        $applications->reason = $request->reason;
        $applications->duration = $request->duration;
        $applications->statuses_id = $request->statuses_id;
        $applications->approver_id = $request->approver_id;
        $applications->photo = $request->photo;


        if ($applications->save()) {
            return redirect()->back()->with('success', 'Leave Application has been updated!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }


    public function leaveUpdate(Request $request, Hrm_leave_applications $Hrm_leave_applications)
    {

        if ($request->leaveStatus == "Approved") {
            $leaveStatus = 4;
        } elseif ($request->leaveStatus == "Rejected") {
            $leaveStatus = 5;
        } else {
            $leaveStatus = 8;
        }

        $applications = Hrm_leave_applications::find($request->id);
        // $applications->employees_id = $request->employees_id;
        $applications->statuses_id = $leaveStatus;
        $applications->approver_id = Auth::user()->id;

        if ($applications->save()) {
            return redirect()->back()->with('success', 'Leave Application has been updated!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }



    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_leave_applications $Hrm_leave_applications, $id)
    {

        $del = Hrm_leave_applications::destroy($id);
        if ($del) {
            return redirect('hrm_leave_applications')->with('success', "Leave Application has been Deleted");
        }
    }





}
