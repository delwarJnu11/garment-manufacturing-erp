<?php

namespace App\Http\Controllers;

use App\Models\Hrm_employees;
use App\Models\Hrm_payslips;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmPayslipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payslips = Hrm_payslips::paginate(5);
         //print_r($employees);

         return view('pages.hrm.payroll.hrm_payslips.index', compact('payslips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=Hrm_statuses::all();
        $employees=Hrm_employees::all();
        return view('pages.hrm.payroll.hrm_payslips.create', compact('status','employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

   // store

    }

    public function show(Hrm_payslips $Hrm_payslips, $id)
    {
        $employees = Hrm_payslips::find($id);
        return view('pages.hrm.employee.hrm_employee.employee_details', compact('employees'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_payslips $Hrm_payslips, $id)
    {
       //edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_payslips $Hrm_payslips, $id)
    {
       //update
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_payslips $Hrm_payslips, $id)
    {

        $del = Hrm_payslips::destroy($id);
        if ($del) {
            return redirect('hrm_payslips')->with('success', "employee has been Deleted");
        }
    }

    // public function find_employee($id){
	// 	$employees = Hrm_employees::find($id);
	// 	return response()->json(['employees'=> $employees]);
	// }
}
