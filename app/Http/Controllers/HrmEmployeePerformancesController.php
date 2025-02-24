<?php

namespace App\Http\Controllers;

use App\Models\Hrm_departments;
use App\Models\Hrm_designations;
use App\Models\Hrm_employee_performances;
use App\Models\Hrm_employees;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmEmployeePerformancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $performances = Hrm_employee_performances::paginate(5);
         //print_r($employees);

         return view('pages.hrm.employee.hrm_employee_performence.index', compact('performances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
     {
    //     $status=Hrm_statuses::all();
    //     $employees=Hrm_employees::all();
    //     $departments=Hrm_departments::all();
    //     $designations=Hrm_designations::all();
    //     return view('pages.hrm.employee.hrm_employee_performence.create', compact('status','departments','designations','employees'));
    $status = Hrm_statuses::all();
    $employees = Hrm_employees::all();
    $departments = Hrm_departments::all();
    $designations = Hrm_designations::all();
    return view('pages.hrm.employee.hrm_employee_performence.create', compact('status', 'departments', 'designations', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'employees_id' => 'required|string|max:50',
        //     'department_id' => 'required|string|max:200',
        //     'designations_id' => 'required|string|max:200',
        //     'statuses_id' => 'required|string|max:200',
        //     'branch' => 'required|string|max:200',
        //     'subject' => 'required|string|max:200',
        //     'goals' => 'required|string|max:200',
        //     'target_achievement	' => 'required|string|max:200',
        //     'target_rating' => 'required|string|max:200',
        //     'overall_rating' => 'required|string|max:200',
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date',
        //     'feedback' => 'required|string|max:200',
        //     'appraisal_date' => 'required|date',
        // ]);

        // $performances = new Hrm_employee_performances();
        // $performances->employees_id= $request->employees_id;
        // $performances->department_id= $request->department_id;
        // $performances->designations_id= $request->designations_id;
        // $performances->statuses_id= $request->statuses_id;
        // $performances->branch= $request->branch;
        // $performances->subject= $request->subject;
        // $performances->goals= $request->goals;
        // $performances->target_achievement= $request->target_achievement;
        // $performances->target_rating= $request->target_rating;
        // $performances->overall_rating= $request->overall_rating;
        // $performances->start_date= $request->start_date;
        // $performances->end_date= $request->end_date;
        // $performances->feedback= $request->feedback;
        // $performances->appraisal_date= $request->appraisal_date;

        // if($performances->save()){
        //     return redirect()->back()->with('success', 'Employee Performence has been added successfully!');
        //  } ;

        $request->validate([
            'employees_id' => 'required|string|max:50',
            'department_id' => 'required|string|max:200',
            'designations_id' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'branch' => 'required|string|max:200',
            'subject' => 'required|string|max:200',
            'goals' => 'required|string|max:200',
            'target_achievement' => 'required|numeric', // Changed to numeric
            'target_rating' => 'required|numeric',      // Changed to numeric
            'overall_rating' => 'required|numeric',     // Changed to numeric
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'feedback' => 'required|string|max:200',
            'appraisal_date' => 'required|date',
        ]);

        $performances = new Hrm_employee_performances();
        $performances->employees_id = $request->employees_id;
        $performances->department_id = $request->department_id;
        $performances->designations_id = $request->designations_id;
        $performances->statuses_id = $request->statuses_id;
        $performances->branch = $request->branch;
        $performances->subject = $request->subject;
        $performances->goals = $request->goals;
        $performances->target_achievement = $request->target_achievement;
        $performances->target_rating = $request->target_rating;
        $performances->overall_rating = $request->overall_rating;
        $performances->start_date = $request->start_date;
        $performances->end_date = $request->end_date;
        $performances->feedback = $request->feedback;
        $performances->appraisal_date = $request->appraisal_date;

        // Save performance and handle the redirect
        if ($performances->save()) {
            return redirect()->back()->with('success', 'Employee Performance has been added successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_employee_performances $Hrm_employee_performances, $id)
    {
        $performances = Hrm_employee_performances::find($id);
        return view('pages.hrm.employee.hrm_employee_performence.show', compact('performances'));
    }

    // public function show(Hrm_employee_performances $Hrm_employee_performances, $id)
    // {
    //     $performances = Hrm_employee_performances::find($id);
    //     return view('pages.hrm.employee.hrm_employee_performence.employee_details', compact('employees'));
    // }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_employee_performances $Hrm_employee_performances, $id)
    {
        $performances = Hrm_employee_performances::find($id);
        $employees=Hrm_employees::all();
        $status = Hrm_statuses::all();
        $departments=Hrm_departments::all();
        $designations=Hrm_designations::all();
        return view('pages.hrm.employee.hrm_employee_performence.update', compact('performances', 'status', 'departments','designations','employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_employee_performances $Hrm_employee_performances, $id)
    {

        $request->validate([
            'employees_id' => 'required|string|max:50',
            'department_id' => 'required|string|max:200',
            'designations_id' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'branch' => 'required|string|max:200',
            'subject' => 'required|string|max:200',
            'goals' => 'required|string|max:200',
            'target_achievement	' => 'required|string|max:200',
            'target_rating' => 'required|string|max:200',
            'overall_rating' => 'required|string|max:200',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'feedback' => 'required|string|max:200',
            'appraisal_date' => 'required|date',
        ]);

        $performances = Hrm_employee_performances::find($id);
        $performances->employees_id= $request->employees_id;
        $performances->department_id= $request->department_id;
        $performances->designations_id= $request->designations_id;
        $performances->statuses_id= $request->statuses_id;
        $performances->branch= $request->branch;
        $performances->subject= $request->subject;
        $performances->goals= $request->goals;
        $performances->target_achievement= $request->target_achievement;
        $performances->target_rating= $request->target_rating;
        $performances->overall_rating= $request->overall_rating;
        $performances->start_date= $request->start_date;
        $performances->end_date= $request->end_date;
        $performances->feedback= $request->feedback;
        $performances->appraisal_date= $request->appraisal_date;



        if($performances->save()){
            return redirect('hrm_employee_performances')->with('success', 'employee performance has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_employee_performances $Hrm_employee_performances, $id)
    {

        $del = Hrm_employee_performances::destroy($id);
        if ($del) {
            return redirect('hrm_employee_performances')->with('success', "employee performence has been Deleted");
        }
    }
}

