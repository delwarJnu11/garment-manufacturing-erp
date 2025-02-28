<?php

namespace App\Http\Controllers;

use App\Models\Hrm_employees;
use App\Models\Hrm_leave_application_approvers;
use App\Models\Hrm_leave_applications;
use App\Models\Hrm_leave_types;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmLeaveApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Hrm_leave_applications::paginate(5);
         //print_r($employees);

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
        $request->validate([
            'employees_id' => 'required|string|max:50',
            'leave_type_id' => 'required|string|max:200',
            'date' => 'required|string|max:200',
            'start_date' => 'required|string|max:200',
            'end_date' => 'required|string|max:200',
            'number_of_days	' => 'required|string|max:200',
            'reason' => 'required|string|max:200',
            'duration' => 'required|numeric',
            'statuses_id' => 'required|numeric',
            'approver_id' => 'required|numeric',
            'photo' => 'required|string|max:200',
        ]);

        $applications = new Hrm_leave_applications();
        $applications->employees_id = $request->employees_id;
        $applications->	leave_type_id = $request->	leave_type_id;
        $applications->date = $request->date;
        $applications->start_date = $request->start_date;
        $applications->end_date = $request->end_date;
        $applications->number_of_days	 = $request->number_of_days	;
        $applications->	reason = $request->	reason;
        $applications->duration = $request->duration;
        $applications->statuses_id = $request->statuses_id;
        $applications->approver_id = $request->approver_id;
        $applications->photo = $request->photo;


        // Save performance and handle the redirect
        if ($applications->save()) {
            return redirect()->back()->with('success', 'Leave Application has been added successfully!');
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
        return view('pages.hrm.leave.hrm_leave_applications.update', compact('applications', 'status', 'leave_types','approvers','employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_leave_applications $Hrm_leave_applications, $id)
    {

        $request->validate([
            'employees_id' => 'required|string|max:50',
            'leave_type_id' => 'required|string|max:200',
            'date' => 'required|string|max:200',
            'start_date' => 'required|string|max:200',
            'end_date' => 'required|string|max:200',
            'number_of_days	' => 'required|string|max:200',
            'reason' => 'required|string|max:200',
            'duration' => 'required|numeric',
            'statuses_id' => 'required|numeric',
            'approver_id' => 'required|numeric',
            'photo' => 'required|string|max:200',
        ]);

        $applications = new Hrm_leave_applications();
        $applications->employees_id = $request->employees_id;
        $applications->	leave_type_id = $request->	leave_type_id;
        $applications->date = $request->date;
        $applications->start_date = $request->start_date;
        $applications->end_date = $request->end_date;
        $applications->number_of_days	 = $request->number_of_days	;
        $applications->	reason = $request->	reason;
        $applications->duration = $request->duration;
        $applications->statuses_id = $request->statuses_id;
        $applications->approver_id = $request->approver_id;
        $applications->photo = $request->photo;


        if($applications->save()){
            return redirect('hrm_leave_applications')->with('success', 'Leave Application has been updated successfully!');
         } ;
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

