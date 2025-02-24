<?php

namespace App\Http\Controllers;

use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = Hrm_statuses::paginate(5);
        // print_r($status);

        return view('pages.hrm.hrm_status.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.hrm.hrm_status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200'
        ]);

        $status = new Hrm_statuses();
        $status->name = $request->name;
        $status->description = $request->description;

        if ($status->save()) {
            return redirect()->back()->with('success', 'Status has been added successfully!');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_statuses $hrm_statuses, $id)
    {
        $status = Hrm_statuses::find($id);
        return view('pages.hrm.hrm_status.show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_statuses $hrm_statuses, $id)
    {
        $status = Hrm_statuses::find($id);

        return view('pages.hrm.hrm_status.update', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_statuses $hrm_statuses, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200'
        ]);

        $status = Hrm_statuses::find($id);
        $status->name = $request->name;
        $status->description = $request->description;

        if ($status->save()) {
            return redirect('hrm_status')->with('success', "Status has been updated");
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_statuses $hrm_statuses, $id)
    {

        $del = Hrm_statuses::destroy($id);
        if ($del) {
            return redirect('hrm_status')->with('success', "Status has been Deleted");
        }
    }
}
