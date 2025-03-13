<?php

namespace App\Http\Controllers;

use App\Models\Hrm_leave_types;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmLeaveTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Hrm_leave_types::paginate(5);
         //print_r($leaves);

        return view('pages.hrm.leave.hrm_leave_types.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=Hrm_statuses::all();
        return view('pages.hrm.leave.hrm_leave_types.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            // 'code' => 'required|string|max:200',
            'description' => 'required|string|max:200',
            'max_days' => 'required|integer|max:200',
            // 'is_paid' => 'required|boolean',
            // 'requires_approval' => 'required|boolean',
            // 'carry_forward' => 'required|boolean',
            // 'statuses_id' => 'required|integer',
        ]);


        $leaves = new Hrm_leave_types();
        $leaves->name= $request->name;
        // $leaves->code= $request->code;
        $leaves->description= $request->description;
        $leaves->max_days= $request->max_days;
        // $leaves->is_paid= $request->is_paid;
        // $leaves->requires_approval= $request->requires_approval;
        // $leaves->carry_forward= $request->carry_forward;
        // $leaves->statuses_id= $request->statuses_id;

        if($leaves->save()){
            return redirect()->back()->with('success', 'leaves has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_leave_types $Hrm_leave_types, $id)
    {
        $leaves = Hrm_leave_types::find($id);
        return view('pages.hrm.leave.hrm_leave_types.show', compact('leaves'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_leave_types $Hrm_leave_types, $id)
    {
        $leaves = Hrm_leave_types::find($id);
        $status = Hrm_statuses::all();

        return view('pages.hrm.leave.hrm_leave_types.update', compact('leaves', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_leave_types $Hrm_leave_types, $id)
    {

        $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:200',
            'description' => 'required|string|max:200',
            'max_days' => 'required|integer|max:200',
            'is_paid' => 'required|boolean',
            'requires_approval' => 'required|boolean',
            'carry_forward' => 'required|boolean',
            'statuses_id' => 'required|integer',
        ]);


        $leaves = Hrm_leave_types::find($id);
        $leaves->name= $request->name;
        $leaves->code= $request->code;
        $leaves->description= $request->description;
        $leaves->max_days= $request->max_days;
        $leaves->is_paid= $request->is_paid;
        $leaves->requires_approval= $request->requires_approval;
        $leaves->carry_forward= $request->carry_forward;
        $leaves->statuses_id= $request->statuses_id;


        if($leaves->save()){
            return redirect('hrm_leave_types')->with('success', 'leaves has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_leave_types $Hrm_leave_types, $id)
    {

        $del = Hrm_leave_types::destroy($id);
        if ($del) {
            return redirect('hrm_leave_types')->with('success', "leaves has been Deleted");
        }
    }
}
