<?php

namespace App\Http\Controllers;

use App\Models\Hrm_leave_application_approvers;
use App\Models\Hrm_leave_applications;
use App\Models\Hrm_leave_approvers;
use App\Models\Hrm_statuses;
use App\Models\User;
use Illuminate\Http\Request;

class HrmLeaveApplicationApproversController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $approvers = Hrm_leave_application_approvers::paginate(5);
         //print_r($employees);

         return view('pages.hrm.leave.hrm_leave_application_approvers.index', compact('approvers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
     {

        $status = Hrm_statuses::all();
        $users = User::all();
        $leave_applictions = Hrm_leave_applications::all();
        return view('pages.hrm.leave.hrm_leave_application_approvers.create', compact('status', 'users', 'leave_applictions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'leave_application_id' => 'required|string|max:50',
            'approver_user_id' => 'required|string|max:200',
            'date' => 'required|string|max:200',
            'approved_at' => 'required|string|max:200',
            'rejected_at' => 'required|string|max:200',
            'comments	' => 'required|string|max:200',
            'statuses_id' => 'required|numeric',
            'approver_id' => 'required|numeric',
            'photo' => 'required|string|max:200',
        ]);

        $approvers = new Hrm_leave_application_approvers();
        $approvers->leave_application_id = $request->leave_application_id;
        $approvers->	approver_user_id = $request->	approver_user_id;
        $approvers->date = $request->date;
        $approvers->approved_at = $request->approved_at;
        $approvers->rejected_at = $request->rejected_at;
        $approvers->comments	 = $request->comments	;
        $approvers->statuses_id = $request->statuses_id;
        $approvers->approver_id = $request->approver_id;
        $approvers->photo = $request->photo;


        // Save performance and handle the redirect
        if ($approvers->save()) {
            return redirect()->back()->with('success', 'Leave Approver has been added successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_leave_application_approvers $Hrm_leave_application_approvers, $id)
    {
        $approvers = Hrm_leave_application_approvers::find($id);
        return view('pages.hrm.leave.hrm_leave_application_approvers.show', compact('approvers'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_leave_application_approvers $Hrm_leave_application_approvers, $id)
    {
        $approvers = Hrm_leave_application_approvers::find($id);

        $status = Hrm_statuses::all();
        $users = User::all();
        $leave_applictions = Hrm_leave_applications::all();
        return view('pages.hrm.leave.hrm_leave_application_approvers.update', compact('approvers', 'status', 'users','leave_applictions','employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_leave_application_approvers $Hrm_leave_application_approvers, $id)
    {


        $request->validate([
            'leave_application_id' => 'required|string|max:50',
            'approver_user_id' => 'required|string|max:200',
            'date' => 'required|string|max:200',
            'approved_at' => 'required|string|max:200',
            'rejected_at' => 'required|string|max:200',
            'comments	' => 'required|string|max:200',
            'statuses_id' => 'required|numeric',
            'approver_id' => 'required|numeric',
            'photo' => 'required|string|max:200',
        ]);

        $approvers = Hrm_leave_application_approvers::find($id);
        $approvers->leave_application_id = $request->leave_application_id;
        $approvers->approver_user_id = $request->approver_user_id;
        $approvers->date = $request->date;
        $approvers->approved_at = $request->approved_at;
        $approvers->rejected_at = $request->rejected_at;
        $approvers->comments= $request->comments	;
        $approvers->statuses_id = $request->statuses_id;
        $approvers->approver_id = $request->approver_id;
        $approvers->photo = $request->photo;

        if($approvers->save()){
            return redirect('hrm_leave_application_approvers')->with('success', 'Leave Application has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_leave_application_approvers $Hrm_leave_application_approvers, $id)
    {

        $del = Hrm_leave_application_approvers::destroy($id);
        if ($del) {
            return redirect('hrm_leave_application_approvers')->with('success', "Leave Application has been Deleted");
        }
    }
}
