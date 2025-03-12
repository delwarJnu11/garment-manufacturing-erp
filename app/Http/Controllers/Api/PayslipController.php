<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hrm_employees;
use App\Models\Hrm_payslip_details;
use App\Models\Hrm_payslips;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class PayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payslips=Hrm_payslips::all();
        return response()->json(['payslips' => $payslips]);
        // echo 'payslips';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // print_r($request->all());
        $payslips = new Hrm_payslips();
        $payslips->employee_id = $request->employee_id;
        $payslips->statuses_id = $request->statuses_id;
        $payslips->salary_month = $request->salary_month;
        // $payslips->start_date = ""; //$request->start_date;
        // $payslips->end_date = "";  //$request->end_date;
        $payslips->basic_salary = $request->basic_salary;
        // $payslips->payslip_items_id = $request->payslip_items_id;
        $payslips->total_working_days = $request->total_working_days;
        $payslips->working_days_attendance = $request->working_days_attendance;
        $payslips->leaves_taken = $request->leaves_taken;
        $payslips->balance_leaves = $request->balance_leaves;
        $payslips->total_earnings = $request->total_earnings;
        $payslips->	total_deductions = $request->total_deductions;
        $payslips->net_salary = $request->net_salary;
        $payslips->payment_method = $request->payment_method;
        // $payslips->generated_at = ""; //$request->generated_at;

        $payslips->save();

        $lastPayslipId= $payslips->id;
        $payslipData = $request->payslips;

        foreach ($payslipData as $key => $value) {
        $payslip_details = new Hrm_payslip_details();
        $payslip_details->payslip_id=$lastPayslipId;
        $payslip_details->payslip_items_id=$value['item_id'] ;
        // $payslip_details->factor=$value['factor'] ;
        // $payslip_details->allowance_amount=$value['allowance_amount'];
        // $payslip_details->deduction_amount=$value['deduction_amount'] ;
        // $payslip_details->total_amount= $value[''] ;

        $payslip_details->save();
        }

        return response()->json(['success' => "Payslip confirmed successfully"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
