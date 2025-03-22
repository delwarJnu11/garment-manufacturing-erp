<?php

namespace App\Http\Controllers;

use App\Models\Hrm_employees;
use App\Models\Hrm_payslip_items;
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
        $payslip_items=Hrm_payslip_items::all();
        return view('pages.hrm.payroll.hrm_payslips.create', compact('status','employees','payslip_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'employee_id' => 'required|string|max:50',
        //     'name' => 'required|string|max:50',
        //     'email' => 'required|email|max:50',
        //     'phone' => 'required|string|max:50',
        //     // 'gender' => 'required|string|max:10',
        //     'date_of_birth' => 'required|date',
        //     'joining_date' => 'required|date',
        //     'salary' => 'required|numeric',
        //     'branch' => 'required|string|max:50',
        //     'address' => 'required|string|max:200',
        //     'city' => 'required|string|max:200',
        //     'statuses_id' => 'required|integer',
        //     'department_id' => 'required|integer',
        //     'designations_id' => 'required|integer',
        //     'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'certificate' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        //     'resume' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        // ]);

        $payslips = new Hrm_payslips();
        $payslips->employee_id = $request->employee_id;
        $payslips->	statuses_id = $request->statuses_id;
        $payslips->salary_month = $request->salary_month;
        $payslips->start_date = $request->start_date;;
        $payslips->end_date = $request->end_date;;
        $payslips->basic_salary = $request->basic_salary;
        $payslips->	payslip_items_id = $request->payslip_items_id;
        $payslips->total_working_days = $request->total_working_days;
        $payslips->working_days_attendance = $request->working_days_attendance;
        $payslips->leaves_taken = $request->leaves_taken;
        $payslips->balance_leaves = $request->balance_leaves;
        $payslips->total_earnings = $request->total_earnings;
        $payslips->	total_deductions = $request->total_deductions;
        $payslips->net_salary = $request->net_salary;
        $payslips->payment_method = $request->payment_method;
        $payslips->generated_at = $request->generated_at;

        if ($payslips->save()) {
            return redirect()->back()->with('success', 'Payslip has been added successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }


    }

    public function show(Hrm_payslips $Hrm_payslips, $id)
    {
        $payslips = Hrm_payslips::find($id);
        return view('pages.hrm.payroll.hrm_payslips.show', compact('payslips'));
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
