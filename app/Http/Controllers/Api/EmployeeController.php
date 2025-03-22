<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hrm_departments;
use App\Models\Hrm_employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees=Hrm_employees::with('department','designations','statuses', 'bank_accounts')->get();
        return response()->json(['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */

    //  public function department()
    //  {
    //     $departments = Hrm_departments::with('department')->get();
    //     return response()->json(['department' => $departments]);
    //  }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
