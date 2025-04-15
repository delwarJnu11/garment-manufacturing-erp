<?php

namespace App\Http\Controllers;

use App\Models\Hrm_payslip_details;
use App\Models\Hrm_payslip_items;
use App\Models\Hrm_payslips;
use Illuminate\Http\Request;

class HrmPayslipDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payslip_details = Hrm_payslip_details::paginate(10);
         //print_r($departments);

        //return view('pages.hrm.department.hrm_sub_department.index', compact('payslip_details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payslips=Hrm_payslips::all();
        $payslip_items=Hrm_payslip_items::all();
        //return view('pages.hrm.department.hrm_sub_department.create', compact('payslips','payslip_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:50',
        //     'description' => 'required|string|max:200',
        //     'statuses_id' => 'required|string|max:200',
        //     'departments_id' => 'required|string|max:200'
        // ]);

        $payslip_details = new Hrm_payslip_details();
        $payslip_details->payslip_id= $request->payslip_id;
        $payslip_details->payslip_items_id= $request->payslip_items_id;
        $payslip_details->factor= $request->factor;
        $payslip_details->allowance_amount= $request->allowance_amount;
        $payslip_details->deduction_amount	= $request->deduction_amount	;
        $payslip_details->total_amount= $request->total_amount;

        if($payslip_details->save()){
            return redirect()->back()->with('success', 'sub_departments has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_payslip_details $Hrm_payslip_details, $id)
    {
        $departments = Hrm_payslip_details::find($id);
        return view('pages.hrm.department.hrm_sub_department.show', compact('departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_payslip_details $Hrm_payslip_details, $id)
    {
        $payslip_details = Hrm_payslip_details::find($id);
        $payslips=Hrm_payslips::all();
        $payslip_items=Hrm_payslip_items::all();

        return view('pages.hrm.department.hrm_sub_department.update', compact('payslip_details', 'payslips', 'payslip_items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_payslip_details $Hrm_payslip_details, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'departments_id' => 'required|string|max:200'
        ]);

        $departments = Hrm_payslip_details::find($id);
        $departments->name= $request->name;
        $departments->statuses_id= $request->statuses_id;
        $departments->departments_id= $request->departments_id;
        $departments->description= $request->description;


        if($departments->save()){
            return redirect('Hrm_payslip_details')->with('success', 'Sub_departments has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_payslip_details $Hrm_payslip_details, $id)
    {

        $del = Hrm_payslip_details::destroy($id);
        if ($del) {
            return redirect('Hrm_payslip_details')->with('success', "departments has been Deleted");
        }
    }
}
