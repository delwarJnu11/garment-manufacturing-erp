<?php

namespace App\Http\Controllers;

use App\Models\Hrm_departments;
use App\Models\Hrm_designations;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmDesignationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = Hrm_designations::paginate(5);
         //print_r($designations);

         return view('pages.hrm.hrm_designations.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=Hrm_statuses::all();
        $departments=Hrm_departments::all();
        return view('pages.hrm.hrm_designations.create', compact('status','departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'department_id' => 'required|string|max:200'
        ]);

        $designations = new Hrm_designations();
        $designations->name= $request->name;
        $designations->statuses_id= $request->statuses_id;
        $designations->department_id= $request->department_id;
        $designations->description= $request->description;

        if($designations->save()){
            return redirect()->back()->with('success', 'sub_departments has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_designations $Hrm_designations, $id)
    {
        $designations = Hrm_designations::find($id);
        return view('pages.hrm.hrm_designations.show', compact('designations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_designations $Hrm_designations, $id)
    {
        $designations = Hrm_designations::find($id);
        $status = Hrm_statuses::all();
        $department=Hrm_departments::all();

        return view('pages.hrm.hrm_designations.update', compact('departments', 'status', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_designations $Hrm_designations, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'departments_id' => 'required|string|max:200'
        ]);

        $designations = Hrm_designations::find($id);
        $designations->name= $request->name;
        $designations->statuses_id= $request->statuses_id;
        $designations->departments_id= $request->departments_id;
        $designations->description= $request->description;


        if($designations->save()){
            return redirect('Hrm_designations')->with('success', 'designations has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_designations $Hrm_designations, $id)
    {

        $del = Hrm_designations::destroy($id);
        if ($del) {
            return redirect('Hrm_designations')->with('success', "designations has been Deleted");
        }
    }
}
