<?php

namespace App\Http\Controllers;

use App\Models\Hrm_employees;
use App\Models\Hrm_payslip_items;
use Illuminate\Http\Request;

class HrmPayslipItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payslip_items = Hrm_payslip_items::paginate(10);
         // print_r($payslip_items);

        return view('pages.hrm.payroll.hrm_payslip_items.index', compact('payslip_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees=Hrm_employees::all();
        return view('pages.hrm.payroll.hrm_payslip_items.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'factor' => 'required|string|max:200',
        ]);

        $payslip_items = new Hrm_payslip_items();
        $payslip_items->name= $request->name;
        $payslip_items->factor= $request->factor;

        if($payslip_items->save()){
            return redirect()->back()->with('success', 'Payslip Items has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_payslip_items $Hrm_payslip_items, $id)
    {
        // $departments = Hrm_payslip_items::find($id);
        // return view('pages.hrm.payroll.hrm_payslip_items.show', compact('departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_payslip_items $Hrm_payslip_items, $id)
    {
        // $departments = Hrm_payslip_items::find($id);
        // $status = Hrm_employees::all();

        // return view('pages.hrm.payroll.hrm_payslip_items.update', compact('departments', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_payslip_items $Hrm_payslip_items, $id)
    {
        // $request->validate([
        //     'name' => 'required|string|max:50',
        //     'description' => 'required|string|max:200',
        //     'statuses_id' => 'required|string|max:200'
        // ]);

        // $departments = Hrm_payslip_items::find($id);
        // $departments->name= $request->name;
        // $departments->statuses_id= $request->statuses_id;
        // $departments->description= $request->description;

        // if($departments->save()){
        //     return redirect('hrm_payslip_items')->with('success', 'departments has been updated successfully!');
        //  } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_payslip_items $Hrm_payslip_items, $id)
    {

        // $del = Hrm_payslip_items::destroy($id);
        // if ($del) {
        //     return redirect('hrm_payslip_items')->with('success', "departments has been Deleted");
        // }
    }


    //  public function find_payslip_items(Request $request){
	// 	$payslip_items = Hrm_payslip_items::find($request->id);
	// 	return response()->json(['payslip_items'=> $payslip_items]);
	// }


}
